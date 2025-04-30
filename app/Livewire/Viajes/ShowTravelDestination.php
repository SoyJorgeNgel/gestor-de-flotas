<?php

namespace App\Livewire\Viajes;

use App\Models\Destination;
use App\Models\RouteLog;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowTravelDestination extends Component
{
    public $travelId, $destEditId, $embarque, $dest_select, $delete_id;
    public $openEditDest = false;
    public $destEdit = ['numberShipment' => '', 'destination_id' => ''];

    public function mount($travelId)
    {
        $this->travelId = $travelId;
        $this->dest_select = Destination::all();
    }
    #[On('show-dest')]
    public function render()
    {
        ($this->travelId);
        $detinations = RouteLog::where('travel_id', $this->travelId)
            ->get();

        return view('livewire.viajes.show-travel-destination', compact('detinations'));
    }
    public function editDestination($destId) {
        $this->destEditId = $destId;
        $this->openEditDest = true;
        $dest = RouteLog::find($destId);
        $this->destEdit['numberShipment'] = $dest->numberShipment;
        $this->destEdit['destination_id'] = $dest->destination_id;
    }

    public function update() {
        $this->validate([
            'destEdit.numberShipment' => 'required|string|max:255',
            'destEdit.destination_id' => 'required|integer',
        ]);
    
        $dest = RouteLog::find($this->destEditId);
        $dest->update(['numberShipment' => $this->destEdit['numberShipment']]);
        $dest->update(['destination_id' => $this->destEdit['destination_id']]);

        $destUpdate = "El destino " . $this->destEdit['numberShipment'] . " se ha actualizado";
        $this->dispatch('show-dest');
        $this->dispatch('alert' ,$destUpdate);
        $this->reset(['destEditId','destEdit', 'openEditDest']);
    }
    public function deleteConfirmation($destId){
        $this->delete_id = $destId;
        $this->dispatch('show-delete-confirmation2');
    }
    
    #[On('deleteConfirmed2')]
    public function destroy()
    {
        $dest = RouteLog::find($this->delete_id);
        $dest->delete();
        $destDelete = "El destino ".$dest->$dest." se ha eliminado";
        $this->dispatch('alert', $destDelete);
        $this->dispatch('show-dest');
        $this->reset(['delete_id']);
    }
}
