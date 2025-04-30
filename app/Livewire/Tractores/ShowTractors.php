<?php

namespace App\Livewire\Tractores;

use App\Models\Tractor;
use App\Models\Tractores\Truck_model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ShowTractors extends Component
{
    use WithPagination;
    public $search, $tractorEditId, $tractor, $users_select, $models_select, $delete_id;
    public $openEditTractor = false;
    public $tractorEdit = [
        'serialNumber' => '',
        'truck_model_id' => '',
        'plate' => '',
        'mileage' => '',
        'user_id' => ''
    ];


    #[On('tractor-created')]
    public function render()
    {
        // Reset pagination to 1 when the search query changes
        if ($this->search !== '' && $this->search !== old('search')) {
            $this->resetPage();
        }

        $tractors = Tractor::where(function ($query) {
            $query->where('plate', 'like', '%' . $this->search . '%')
                ->orWhere('serialNumber', 'like', '%' . $this->search . '%')
                ->orWhere('mileage', 'like', '%' . $this->search . '%')
                ->orWhereHas('truck_model', function ($truckModelQuery) {
                    $truckModelQuery->where(DB::raw("CONCAT(model, ' ', year)"), 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('user', function ($userQuery) {
                    $userQuery->where(DB::raw("CONCAT(name,' ', paternalSurname, ' ', maternalSurname)"), 'like', '%' . $this->search . '%');

                });
        })->paginate(10);


        return view('livewire.tractores.show-tractors', compact('tractors'));
    }
    public function mount()
    {
        $this->models_select = Truck_model::all();
        $this->users_select = User::where('role_id', 3)->get();
    }
    public function editTractor($tractorId)
    {
        $this->tractorEditId = $tractorId;
        $this->openEditTractor = true;
        $tractor = Tractor::find($tractorId);
        $this->tractorEdit['serialNumber'] = $tractor->serialNumber;
        $this->tractorEdit['truck_model_id'] = $tractor->truck_model_id;
        $this->tractorEdit['plate'] = $tractor->plate;
        $this->tractorEdit['mileage'] = $tractor->mileage;
        $this->tractorEdit['user_id'] = $tractor->user_id;
    }

    public function updateTractor()
    {
        $tractor = Tractor::find($this->tractorEditId);
        $tractor->update(['serialNumber' => $this->tractorEdit['serialNumber']]);
        $tractor->update(['truck_model_id' => $this->tractorEdit['truck_model_id']]);
        $tractor->update(['plate' => $this->tractorEdit['plate']]);
        $tractor->update(['mileage' => $this->tractorEdit['mileage']]);
        $tractor->update(['user_id' => $this->tractorEdit['user_id']]);
        $tractorUpdate = "El tractor " . $this->tractorEdit['plate'] . " se ha actualizado";
        $this->dispatch('user-created');
        $this->dispatch('alert', $tractorUpdate);
        $this->reset(['tractorEditId', 'tractorEdit', 'openEditTractor']);
    }
    public function deleteConfirmation($tractorId)
    {
        $this->delete_id = $tractorId;
        $this->dispatch('show-delete-confirmation');
    }

    #[On('deleteConfirmed')]
    public function destroy()
    {
        $tractor = Tractor::find($this->delete_id);
        $tractor->delete();
        $tractorDelete = "El tractor se ha eliminado";
        $this->dispatch('tractor-created');
        $this->dispatch('alert', $tractorDelete);
        $this->reset(['delete_id']);
    }
}
