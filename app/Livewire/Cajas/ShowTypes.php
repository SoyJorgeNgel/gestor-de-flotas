<?php

namespace App\Livewire\Cajas;

use App\Models\Cajas\Box_type;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTypes extends Component
{
    use WithPagination;

    public $search, $typeEditId, $type;
    public $openEditType = false;
    public $typeEdit = ['name' => ''];
    public $tablaId, $delete_id;

    public function mount($tablaId)
    {
        $this->tablaId = $tablaId;
    }
    #[On('box_type-created')]
    public function render()
    {
        // Reset pagination to 1 when the search query changes
        if ($this->search !== null && $this->search !== old('search')) {
            $this->resetPage();
        }

        $box_types = Box_type::where('name', 'like', '%' . $this->search . '%')
            ->paginate(3);

        return view('livewire.cajas.show-types', compact('box_types'));
    }

    public function editType($typeId)
    {
        $this->typeEditId = $typeId;
        $this->openEditType = true;
        $type = Box_type::find($typeId);
        $this->typeEdit['name'] = $type->name;
    }

    public function updateType()
    {
        $this->validate([
            'typeEdit.name' => 'required|string|max:255|unique:box_types,name,' . $this->typeEditId
        ]);

        $type = Box_type::find($this->typeEditId);
        $type->update(['name' => $this->typeEdit['name']]);
        $typeUpdate = "El tipo de caja " . $this->typeEdit['name'] . " ha sido actualizado";
        $this->dispatch('alert', $typeUpdate);
        $this->reset(['typeEditId', 'typeEdit', 'openEditType']);
    }
    public function deleteConfirmation($typeId)
    {
        $this->delete_id = $typeId;
        $this->dispatch('show-delete-confirmation');
    }
    #[On('deleteConfirmed')]
    public function destroy()
    {
        $type = Box_type::find($this->delete_id);
        $type->delete();
        $typeDelete = "El tipo de caja se ha eliminado";
        $this->dispatch('box_type-created');
        $this->dispatch('alert', $typeDelete);
        $this->reset(['delete_id']);
    }
}
