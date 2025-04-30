<?php

namespace App\Livewire\Cajas;

use App\Models\Box;
use App\Models\Cajas\Box_permit;
use App\Models\Cajas\Box_size;
use App\Models\Cajas\Box_type;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ShowBoxes extends Component
{
    use WithPagination;
    public $search, $delete_id,$boxEditId,$box, $boxType_select, $boxSize_select, $boxPermit_select;
    public $open_edit = false; //variable de modal
    //Array para guardar los datos al editar.
    public $boxEdit = [
        'boxType' => '',
        'plate' => '',
        'boxSize' => '',
        'boxPermit' => '',
    ];
    #[On('box-created')]
    public function render()
    {
        // Resetea la busqueda
        if ($this->search !== '' && $this->search !== old('search')) {
            $this->resetPage();
        }
        //consulta las cajas segun lo buscado
        $boxes = Box::where(function ($query) {
            $query->where('plate', 'like', '%' . $this->search . '%')
                  ->orWhereHas('box_permit', function ($permitQuery) {
                      $permitQuery->where('name', 'like', '%' . $this->search . '%'); // name es un campo de la tabla relacionada de 'permit'
                  })
                  ->orWhereHas('box_size', function ($sizeQuery) {
                      $sizeQuery->where('name', 'like', '%' . $this->search . '%'); // Description es un campo de la tabla relacionada de 'size'
                  })
                  ->orWhereHas('box_type', function ($typeQuery) {
                      $typeQuery->where('name', 'like', '%' . $this->search . '%'); // Type es un campo de la tabla relacionada de 'type'
                  });
        })->paginate(5);
        

        return view('livewire.cajas.show-boxes', compact('boxes'));
    }
    public function mount(Box $box) {
        $this->box = $box;
        $this->boxType_select = Box_type::all();
        $this->boxSize_select = Box_size::all();
        $this->boxPermit_select = Box_permit::all();
    }
    public function editBox($userId)
    {
        $this->boxEditId = $userId;
        $this->open_edit = true;
        $box = Box::find($userId);
        $this->boxEdit['boxType'] = $box->box_type_id;
        $this->boxEdit['plate'] = $box->plate;
        $this->boxEdit['boxSize'] = $box->box_size_id;
        $this->boxEdit['boxPermit'] = $box->box_permit_id;
    }

    public function update()
    {
        $box = Box::find($this->boxEditId);
        $box->update([
            'boxType' => $this->boxEdit['boxType'],
            'plate' => $this->boxEdit['plate'],
            'boxSize' => $this->boxEdit['boxSize'],
            'boxPermit' => $this->boxEdit['boxPermit']
        ]);
        $boxUpdate = "La caja " . $this->boxEdit['plate'] . " se ha actualizado";
        $this->dispatch('box-created');
        $this->dispatch('alert' ,$boxUpdate);
        $this->reset(['boxEdit', 'boxEditId', 'open_edit']);
    }
    public function deleteConfirmation($boxId){
        $this->delete_id = $boxId;
        $this->dispatch('show-delete-confirmation');
    }

    #[On('deleteConfirmed')]
    public function destroy()
    {
        $box = Box::find($this->delete_id);
        $box->delete();
        $boxDelete = "La caja se ha eliminado";
        $this->dispatch('user-created');
        $this->dispatch('alert' ,$boxDelete);
        $this->reset(['delete_id']);
    }
    
}
