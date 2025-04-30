<?php

namespace App\Livewire\Tractores;

use App\Models\Tractores\Truck_brand;
use App\Models\Tractores\Truck_model;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowModels extends Component
{
    use WithPagination;

    public $search, $modelEditId, $model, $brands_select;
    public $openEditModel = false;
    public $modelEdit = ['model' => '', 'year' => '', 'brand' => ''];
    public $tablaId, $delete_id;
    #[On('model-created')]
    public function mount($tablaId)
    {
        $this->tablaId = $tablaId;
        $this->brands_select = Truck_brand::all();
    }
    #[On('model-created')]
    public function render()
    {
        // Reset pagination to 1 when the search query changes
        if ($this->search !== null && $this->search !== old('search')) {
            $this->resetPage();
        }

        $truck_models = Truck_model::where(function ($query) {
            $query->where('model', 'like', '%' . $this->search . '%')
                  ->orWhere('year', 'like', '%' . $this->search . '%')
                  ->orWhereHas('truck_brand', function ($brandQuery) {
                      $brandQuery->where('name', 'like', '%' . $this->search . '%'); // Asumiendo que 'name' es un campo de la tabla relacionada 'truck_brands'
                  });
        })->paginate(3);

        return view('livewire.tractores.show-models', compact('truck_models'));
    }
    
    public function editModel($modelId) {
        $this->modelEditId = $modelId;
        $this->openEditModel = true;
        $model = Truck_model::find($modelId);
        $this->modelEdit['model'] = $model->model;
        $this->modelEdit['year'] = $model->year;
        $this->modelEdit['brand'] = $model->truck_brand_id;
    }

    public function updateModel() {
        $validateData = $this->validate([
            'modelEdit.model' => 'required|string|max:255',
            'modelEdit.year' => 'required|integer',
            'modelEdit.brand' => 'required|integer|max:255',
        ], [
            'modelEdit.model.unique' => 'Ya existe un registro con los mismos valores.'
        ]);
    
        // Verificar si ya existe un registro con los mismos valores
        if (Truck_model::where('model', $validateData['modelEdit']['model'])
            ->where('year', $validateData['modelEdit']['year'])
            ->where('truck_brand_id', $validateData['modelEdit']['brand'])
            ->where('id', '!=', $this->modelEditId)
            ->exists()) {
            // Si existe, agregar el error manualmente
            $this->addError('modelEdit.model', 'Ya existe un registro con los mismos valores.');
            return;
        }
        $model = Truck_model::find($this->modelEditId);
        $model->update(['model' => $this->modelEdit['model']]);
        $model->update(['year' => $this->modelEdit['year']]);
        $model->update(['truck_brand_id' => $this->modelEdit['brand']]);

        $modelUpdate = "El modelo " . $this->modelEdit['model'] . " " .$this->modelEdit['year']. " se ha actualizado";
        $this->dispatch('model-created');
        $this->dispatch('alert' ,$modelUpdate);
        $this->reset(['modelEditId','modelEdit', 'openEditModel']);
    }
    public function deleteConfirmation($modelId){
        $this->delete_id = $modelId;
        $this->dispatch('show-delete-confirmation2');
    }
    
    #[On('deleteConfirmed2')]
    public function destroy()
    {
        $model = Truck_model::find($this->delete_id);
        $model->delete();
        $modelDelete = "El modelo ".$model->model." se ha eliminado";
        $this->dispatch('alert', $modelDelete);
        $this->dispatch('model-created');
        $this->reset(['delete_id']);
    }
    
}
