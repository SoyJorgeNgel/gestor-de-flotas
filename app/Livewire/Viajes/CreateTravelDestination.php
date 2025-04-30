<?php

namespace App\Livewire\Viajes;

use App\Models\Destination;
use App\Models\RouteLog;
use Livewire\Component;

class CreateTravelDestination extends Component
{
    public $open=false;
    public $dest_select, $travelId, $destination_id , $numberShipment;
    public function render()
    {
        return view('livewire.viajes.create-travel-destination');
    }
    public function mount($travelId)
    {
        $this->travelId = $travelId;
        $this->dest_select = Destination::all();
    }
    public function register() {
        $validateData = $this->validate([
            'destination_id' => 'required|string',
            'numberShipment' => 'required|integer',
        ]);

        RouteLog::create([
            'travel_id' => $this->travelId,
            'destination_id' => $validateData['destination_id'],
            'numberShipment' => $validateData['numberShipment']
        ]);

        $destCreate = "El destino " . $this->numberShipment . " se ha creado";
        $this->dispatch('show-dest');
        $this->dispatch('alert' ,$destCreate);

        $this->reset(['open', 'destination_id', 'numberShipment']);
    }
}
