<?php

namespace App\Livewire\Cajas;

use App\Models\Cajas\Box_permit;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPermit extends Component
{
    use WithPagination;
    public $search, $permitEditId, $permit;
    public $openEditPermit = false;
    public $permitEdit = ['name' => ''];
    public $tablaId,$delete_id;
    public function mount($tablaId)
    {
        $this->tablaId = $tablaId;
    }
    
    #[On('box_permit-created')]
    public function render()
    {
        if($this->search !== null && $this->search !== old('search')){
            $this->resetPage();
        }
        $box_permit = Box_permit::where('name', 'like', '%' . $this->search . '%')->paginate(3);
        return view('livewire.cajas.show-permit', compact('box_permit'));
    }
    public function editPermit($permitId) {
        $this->permitEditId = $permitId;
        $this->openEditPermit = true;
        $permit = Box_permit::find($permitId);
        $this->permitEdit['name'] = $permit->name;
    }

    public function updatePermit() {
        $this->validate([
            'permitEdit.name' => 'required|string|max:255|unique:box_permits,name,' . $this->permitEditId
        ]);
        $permit = Box_permit::find($this->permitEditId);
        $permit->update(['name' => $this->permitEdit['name']]);
        $permitUpdate = "El permiso " . $this->permitEdit['name'] . " ha sido actualizado";
        $this->dispatch('alert', $permitUpdate);
        $this->reset(['permitEditId','permitEdit', 'openEditPermit']);
    }
    public function deleteConfirmation($permitId)
    {
        $this->delete_id = $permitId;
        $this->dispatch('show-delete-confirmation4');
    }
    #[On('deleteConfirmed4')]
    public function destroyPermit(){
        $permit = Box_permit::find($this->delete_id);
        $permit->delete();
        $permitDelete = "El permiso se ha eliminado";
        $this->dispatch('box_permit-created');
        $this->dispatch('alert', $permitDelete);
        $this->reset(['delete_id']);
    }
}
