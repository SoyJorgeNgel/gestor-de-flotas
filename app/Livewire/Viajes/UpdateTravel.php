<?php

namespace App\Livewire\Viajes;

use App\Models\Box;
use App\Models\Cajas\Box_cargo;
use App\Models\Cajas\Box_type;
use App\Models\Departure;
use App\Models\Destination;
use App\Models\Status;
use App\Models\Tractor;
use App\Models\Travels;
use App\Models\User;
use Livewire\Component;

class UpdateTravel extends Component
{
    public $travel;
    public $departure_id, $invoiceDate, $departureDate, $departureTime, $returnDate, $returnTime,
        $userId, $tractor_id, $box_cargo_id, $boxTypeId, $boxId, $quantity, $freightCost, $boothCost, $expense, $kmTraveled, $status_id;
    public $departure_select, $user_select, $tractors = [], $box_cargo_select, $box_type_select, $box_select = [], $destination_select, $status_select;

    public function mount()
    {
        $travelId = request()->query('id');

        // Cargar los datos del viaje utilizando $travelId
        $this->travel = Travels::findOrFail($travelId);
        //dd($this->travel);

        $this->departure_select = Departure::all();
        $this->user_select = User::where('role_id', 3)->get();
        $this->tractors = collect();
        $this->box_cargo_select = Box_cargo::all();
        $this->box_type_select = Box_type::all();
        $this->box_select = collect();
        $this->destination_select = Destination::all();
        $this->status_select = Status::all();

        $this->departure_id = $this->travel->departure_id;
        $this->invoiceDate = $this->travel->invoiceDate;
        $this->departureDate = $this->travel->departureDate;
        $this->departureTime = $this->travel->departureTime;
        $this->returnDate = $this->travel->returnDate;
        $this->returnTime = $this->travel->returnTime;
        $this->userId = $this->travel->user_id;
        $this->updatedUserId($this->userId);
        $this->box_cargo_id =  $this->travel->box_cargo_id;
        $this->boxTypeId =  $this->travel->box_type_id;
        $this->updatedBoxTypeId($this->boxTypeId);
        $this->quantity =  $this->travel->quantity;
        $this->freightCost =  $this->travel->freightCost;
        $this->boothCost =  $this->travel->boothCost;
        $this->expense =  $this->travel->expense;
        $this->kmTraveled =  $this->travel->kmTraveled;
        $this->status_id =  $this->travel->status_id;
    }
    public function updatedUserId($id)
    {
        $this->tractors = Tractor::where('user_id', $id)->get();
        $this->tractor_id = $this->travel->tractor_id ?? null;
    }

    public function updatedBoxTypeId($id)
    {
        $this->box_select = Box::where('box_type_id', $id)->get();
        $this->boxId = $this->travel->box_id ?? null;
    }
    //Calcula es costo sumado las casetas y el flete
    public function updated($propertyName)
    {
        if ($propertyName === 'freightCost' || $propertyName === 'boothCost') {
            $this->calculateExpense();
        }
    }

    public function calculateExpense()
    {
        $this->expense = $this->freightCost + $this->boothCost;
    }

    public function render()
    {
        return view('livewire.viajes.update-travel');
    }
    public function update() {
            // Obtener el viaje que se está editando
    $travel = Travels::findOrFail($this->travel->id);

    // Actualizar los campos del viaje con los valores del componente Livewire
    $travel->departure_id = $this->departure_id;
    $travel->invoiceDate = $this->invoiceDate;
    $travel->departureDate = $this->departureDate;
    $travel->departureTime = $this->departureTime;
    $travel->returnDate = $this->returnDate;
    $travel->returnTime = $this->returnTime;
    $travel->user_id = $this->userId;
    $travel->tractor_id = $this->tractor_id;
    $travel->box_cargo_id = $this->box_cargo_id;
    $travel->box_type_id = $this->boxTypeId;
    $travel->box_id = $this->boxId;
    $travel->quantity = $this->quantity;
    $travel->freightCost = $this->freightCost;
    $travel->boothCost = $this->boothCost;
    $travel->expense = $this->expense;
    $travel->kmTraveled = $this->kmTraveled;
    $travel->status_id = $this->status_id;

    // Guardar los cambios en la base de datos
    $travel->save();

    // Redirigir a la página de detalles del viaje o a donde sea necesario
    return redirect()->route('viajes', ['id' => $travel->id])->with('mensaje', 'Viaje actualizado correctamente');
        
    }
}
