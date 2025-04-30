<?php

namespace App\Livewire;

use App\Models\Role;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsers extends Component
{
    public $open = false;
    public $name;
    public $paternalSurname;
    public $maternalSurname;
    public $email;
    public $password;
    public $password_confirmation;
    public $phoneNumber;
    public $role_id, $role_select;

    public function render()
    {
        return view('livewire.create-users');
    }

    public function mount()
    {
        $this->role_select = Role::all();;
    }

    public function register()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'paternalSurname' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'maternalSurname' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
            'phoneNumber' => 'nullable|digits:10',
            'role_id' => 'required|integer',
        ], [
            'name.regex' => 'El :attribute solo puede contener letras y espacios.',
            'paternalSurname.regex' => 'El :attribute solo puede contener letras y espacios.',
            'maternalSurname.regex' => 'El :attribute solo puede contener letras y espacios.',
            'password.regex' => 'La :attribute debe contener al menos un número, una letra minúscula y una letra mayúscula.',
            'phoneNumber.digits' => 'El :attribute debe tener exactamente 10 dígitos.',
            'role_id.required' => 'El campo :attribute es obligatorio.',
            'role_id.integer' => 'El campo :attribute debe ser un número entero.',
        ], [
            'name' => 'nombre',
            'paternalSurname' => 'apellido paterno',
            'maternalSurname' => 'apellido materno',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'phoneNumber' => 'número de teléfono',
            'role_id' => 'rol',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'paternalSurname' => $validatedData['paternalSurname'],
            'maternalSurname' => $validatedData['maternalSurname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phoneNumber' => $validatedData['phoneNumber'],
            'role_id' => $validatedData['role_id']
        ]);
        $this->dispatch('user-created');

        $userCreated = "El usuario " . $this->name ." ". $this->paternalSurname. " ". $this->maternalSurname. " ha sido creado";
        $this->dispatch('alert' ,$userCreated);

        $this->reset(['open', 'name', 'paternalSurname', 'maternalSurname', 'email', 'password', 'password_confirmation', 'phoneNumber', 'role_id']);
    }
}
