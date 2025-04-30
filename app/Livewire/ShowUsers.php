<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;

    public $search, $userEditId, $user;
    public $open_edit = false;
    public $delete_id, $role_select;
    public $userEdit = [
        'name' => '',
        'paternalSurname' => '',
        'maternalSurname' => '',
        'email' => '',
        'phoneNumber' => null,
        'role_id' => null
    ];

    protected $rules = [
        'userEdit.name' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
        'userEdit.paternalSurname' => 'nullable|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
        'userEdit.maternalSurname' => 'nullable|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
        'userEdit.email' => 'required|string|email|max:255|unique:users,email,{id}',
        'userEdit.phoneNumber' => 'nullable|digits:10',
        'userEdit.role_id' => 'required|integer',
    ];

    protected $messages = [
        'userEdit.name.regex' => 'El nombre solo puede contener letras y espacios.',
        'userEdit.paternalSurname.regex' => 'El apellido paterno solo puede contener letras y espacios.',
        'userEdit.maternalSurname.regex' => 'El apellido materno solo puede contener letras y espacios.',
        'userEdit.email.email' => 'El correo electrónico no es válido.',
        'userEdit.email.unique' => 'El correo electrónico ya está en uso.',
        'userEdit.phoneNumber.digits' => 'El número de teléfono debe tener exactamente 10 dígitos.',
        'userEdit.role_id.integer' => 'El campo :attribute debe ser un número entero.',
    ];

    protected $validationAttributes = [
        'userEdit.name' => 'nombre',
        'userEdit.paternalSurname' => 'apellido paterno',
        'userEdit.maternalSurname' => 'apellido materno',
        'userEdit.email' => 'correo electrónico',
        'userEdit.phoneNumber' => 'número de teléfono',
        'userEdit.role_id' => 'rol',
    ];

    public function edit($userId)
    {
        $this->userEditId = $userId;
        $this->open_edit = true;
        $user = User::findOrFail($userId);
        $this->userEdit['name'] = $user->name;
        $this->userEdit['paternalSurname'] = $user->paternalSurname;
        $this->userEdit['maternalSurname'] = $user->maternalSurname;
        $this->userEdit['email'] = $user->email;
        $this->userEdit['phoneNumber'] = $user->phoneNumber;
        $this->userEdit['role_id'] = $user->role_id;
    }

    public function update()
    {
        $this->rules['userEdit.email'] = 'required|string|email|max:255|unique:users,email,' . $this->userEditId;

        $this->validate();

        // Asegúrate de que el phoneNumber sea null si está vacío

        $user = User::findOrFail($this->userEditId);
        $phoneNumber = $this->userEdit['phoneNumber'] !== '' ? $this->userEdit['phoneNumber'] : null;

        $user->update([
            'name' => $this->userEdit['name'],
            'paternalSurname' => $this->userEdit['paternalSurname'],
            'maternalSurname' => $this->userEdit['maternalSurname'],
            'email' => $this->userEdit['email'],
            'phoneNumber' => $phoneNumber, // Asegúrate de que el valor sea null si está vacío
            'role_id' => $this->userEdit['role_id'], // Asegúrate de que el valor sea null si está vacío
        ]);

        $userUpdate = "El usuario " . $this->userEdit['name'] . " se ha actualizado";
        $this->dispatch('user-updated');
        $this->dispatch('alert', $userUpdate);
        $this->reset(['userEdit', 'userEditId', 'open_edit']);
    }

    #[On('user-created')]
    public function render()
    {
        // Reset pagination to 1 when the search query changes
        $users = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('paternalSurname', 'like', '%' . $this->search . '%')
                ->orWhere('maternalSurname', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phoneNumber', 'like', '%' . $this->search . '%')
                ->orWhereHas('role', function ($roleQuery) {
                    $roleQuery->where('role', 'like', '%' . $this->search . '%');
                });
        })->paginate(5);

        return view('livewire.show-users', compact('users'));
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->role_select = Role::all();;
    }
    public function deleteConfirmation($userId)
    {
        $this->delete_id = $userId;
        $this->dispatch('show-delete-confirmation');
    }

    #[On('deleteConfirmed')]
    public function destroy()
    {
        $user = User::find($this->delete_id);
        $user->delete();
        $userDelete = "El usuario se ha eliminado";
        $this->dispatch('user-created');
        $this->dispatch('alert', $userDelete);
        $this->reset(['delete_id']);
    }
}
