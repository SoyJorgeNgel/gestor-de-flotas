<?php

namespace App\Livewire\Cajas;

use App\Models\Cajas\Box_size;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowSizes extends Component
{
    use WithPagination;

    public $search, $sizeEditId, $size;
    public $openEditSize = false;
    public $sizeEdit = ['size' => ''];
    public $tablaId, $delete_id; // Agrega esta propiedad para almacenar el identificador único

    public function mount($tablaId)
    {
        $this->tablaId = $tablaId;
    }
    #[On('box_size-created')]
    public function render()
    {
        if($this->search !== null && $this->search !== old('search')){
            $this->resetPage();
        }
        $box_sizes = Box_size::where('name', 'like', '%' . $this->search . '%')->paginate(3);
        return view('livewire.cajas.show-sizes', compact('box_sizes'));
    }

    public function editSize($sizeId) {
        $this->sizeEditId = $sizeId;
        $this->openEditSize = true;
        $size = Box_size::find($sizeId);
        $this->sizeEdit['size'] = $size->name;
    }

    public function updateSize() {
        $this->validate([
            'sizeEdit.size' => 'required|string|max:255|unique:box_sizes,name,' . $this->sizeEditId
        ]);
        $size = Box_size::find($this->sizeEditId);
        $size->update(['name' => $this->sizeEdit['size']]);
        $sizeUpdate = "El tamaño de caja " . $this->sizeEdit['size'] . " ha sido actualizado";
        $this->dispatch('alert', $sizeUpdate);
        $this->reset(['sizeEditId','sizeEdit', 'openEditSize']);
    }
    public function deleteConfirmation($sizeId)
    {
        $this->delete_id = $sizeId;
        $this->dispatch('show-delete-confirmation2');
    }

    #[On('deleteConfirmed2')]
    public function destroy(){
        $size = Box_size::find($this->delete_id);
        $size->delete();
        $sizeDelete = "El tamaño de caja se ha eliminado";
        $this->dispatch('box_size-created');
        $this->dispatch('alert', $sizeDelete);
        $this->reset(['delete_id']);
    }
}

