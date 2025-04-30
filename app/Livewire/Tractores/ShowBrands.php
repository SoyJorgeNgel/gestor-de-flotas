<?php

namespace App\Livewire\Tractores;

use App\Models\Tractores\Truck_brand;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ShowBrands extends Component
{
    use WithPagination;

    public $search, $brandEditId, $brand, $delete_id;
    public $openEditBrand = false;
    public $brandEdit = ['name' => ''];
    public $tablaId;

    public function mount($tablaId)
    {
        $this->tablaId = $tablaId;
    }
    #[On('brand-created')]
    public function render()
    {
        if ($this->search !== null && $this->search !== old('search')) {
            $this->resetPage();
        }

        $truck_brands = Truck_brand::where('name', 'like', '%' . $this->search . '%')
            ->paginate(3);
        return view('livewire.tractores.show-brands', compact('truck_brands'));
    }

    public function editBrand($brandId) {
        $this->brandEditId = $brandId;
        $this->openEditBrand = true;
        $brand = Truck_brand::find($brandId);
        $this->brandEdit['name'] = $brand->name;
    }
    
    public function updateBrand() {
        $this->validate([
            'brandEdit.name' => 'required|string|max:255|unique:Truck_brandS,name,' . $this->brandEditId
        ]);
        $brand = Truck_brand::find($this->brandEditId);
        $brand->update(['name' => $this->brandEdit['name']]);
        $brandUpdate = "La marca ".$this->brandEdit['name']." se ha actualizado";
        $this->dispatch('brand-created');
        $this->dispatch('model-created');
        $this->dispatch('alert' ,$brandUpdate);
        $this->reset(['brandEditId','brandEdit', 'openEditBrand']);
    }

    public function deleteConfirmation($userId){
        $this->delete_id = $userId;
        $this->dispatch('show-delete-confirmation');
    }

    #[On('deleteConfirmed')]
    public function destroy()
    {
        $brand = Truck_brand::find($this->delete_id);
        $brand->delete();
        $brandDelete = "La marca ".$this->brandEdit['name']." se ha eliminado";
        $this->dispatch('user-created');
        $this->dispatch('alert' ,$brandDelete);
        $this->reset(['delete_id']);
    }
}
