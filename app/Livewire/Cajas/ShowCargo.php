<?php

namespace App\Livewire\Cajas;

use App\Models\Cajas\Box_cargo;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCargo extends Component
{
    use WithPagination;
    public $search, $cargoEditId, $cargo;
    public $openEditCargo = false;
    public $cargoEdit = ['cargo' => ''];
    public $tablaId, $delete_id;
    public function mount($tablaId)
    {
        $this->tablaId = $tablaId;
    }
    #[On('box_cargo-created')]
    public function render()
    {
        if($this->search !== null && $this->search !== old('search')){
            $this->resetPage();
        }
        $box_cargo = Box_cargo::where('cargo', 'like', '%' . $this->search . '%')->paginate(3);
        return view('livewire.cajas.show-cargo', compact('box_cargo'));
    }
    public function editCargo($cargoId) {
        $this->cargoEditId = $cargoId;
        $this->openEditCargo = true;
        $cargo = Box_cargo::find($cargoId);
        $this->cargoEdit['cargo'] = $cargo->cargo;
    }

    public function updateCargo() {
        $this->validate([
            'cargoEdit.cargo' => 'required|string|max:255|unique:box_cargos,cargo,' . $this->cargoEditId
        ]);
        $cargo = Box_cargo::find($this->cargoEditId);
        $cargo->update(['cargo' => $this->cargoEdit['cargo']]);
        $cargosUpdate = "El tipo de carga " . $this->cargoEdit['cargo'] . " ha sido actualizado";
        $this->dispatch('alert', $cargosUpdate);
        $this->reset(['cargoEditId','cargoEdit', 'openEditCargo']);
    }

    public function deleteConfirmation($cargoId)
    {
        $this->delete_id = $cargoId;
        $this->dispatch('show-delete-confirmation3');
    }

    #[On('deleteConfirmed3')]
    public function destroy(){
        $cargo = Box_cargo::find($this->delete_id);
        $cargo->delete();
        $cargoDelete = "El tipo de carga se ha eliminado";
        $this->dispatch('box_cargo-created');
        $this->dispatch('alert', $cargoDelete);
        $this->reset(['delete_id']);
    }
}
