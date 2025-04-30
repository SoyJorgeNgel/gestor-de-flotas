<?php

namespace App\Livewire\Viajes;

use App\Models\Travels;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTravel extends Component
{
    public $open = false;
    public $travelId;
    public $travelinfo = [
        'travelId' => '',
        'departure_id' => '',
        'invoiceDate' => '',
        'departureDate' => '',
        'departureTime' => '',
        'returnDate' => '',
        'returnTime' => '',
        'user_id' => '',
        'tractor_id' => '',
        'box_cargo_id' => '',
        'box_type_id' => '',
        'box_id' => '',
        'quantity' => '',
        'freightCost' => '',
        'boothCost' => '',
        'expense' => '',
        'kmTraveled' => '',
        'status'=>'',
    ];
    use WithPagination;
    public $search;
    #[On('travel-created')]
    public function render()
    {
        if ($this->search !== '' && $this->search !== old('search')) {
            $this->resetPage();
        }
        if (Auth::user()->role_id == '3') {
            $data = Travels::where('departureDate', 'like', '%' . $this->search . '%')
               ->where('user_id', Auth::user()->id)
               ->orderBy('created_at', 'desc')
               ->paginate(5);
        } else {
            $data = Travels::where('departureDate', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        
        return view('livewire.viajes.show-travel', compact('data'));
    }
    public function edit($Id)
{
    // Aquí puedes agregar lógica adicional, como validar el ID o cargar los datos necesarios desde la base de datos.
    // Por ejemplo, puedes utilizar el modelo Travel para encontrar el viaje con el ID proporcionado.
    $travel = Travels::findOrFail($Id);

    // Redirige a la ruta de edición con el ID del viaje como parámetro
    return redirect()->route('actualizarViaje', ['id' => $Id]);
}
public function info($travelId)
    {
        $this->travelId = $travelId;
        $this->open = true;
        $travel = Travels::find($travelId);
        $this->travelinfo['travelId'] = $travel->id ?? '';
        $this->travelinfo['departure_id'] = $travel->departure->departure ?? '';
        $this->travelinfo['invoiceDate'] = $travel->invoiceDate ?? '';
        $this->travelinfo['departureDate'] = $travel->departureDate ?? '';
        $this->travelinfo['departureTime'] = $travel->departureTime ?? '';
        $this->travelinfo['returnDate'] = $travel->returnDate ?? '';
        $this->travelinfo['returnTime'] = $travel->returnTime ?? '';
        $this->travelinfo['user_id'] = $travel->user->name ." ".$travel->user->paternalSurname ." ".$travel->user->maternalSurname ?? '';
        $this->travelinfo['tractor_id'] = $travel->tractor->plate ?? '';
        $this->travelinfo['box_cargo_id'] = $travel->box_cargo->cargo ?? '';
        $this->travelinfo['box_type_id'] = $travel->box_type->name ?? '';
        $this->travelinfo['box_id'] = $travel->box->plate ?? '';
        $this->travelinfo['quantity'] = $travel->quantity ?? '';
        $this->travelinfo['freightCost'] = $travel->freightCost ?? '';
        $this->travelinfo['boothCost'] = $travel->boothCost ?? '';
        $this->travelinfo['expense'] = $travel->expense ?? '';
        $this->travelinfo['kmTraveled'] = $travel->kmTraveled ?? '';
        $this->travelinfo['status'] = $travel->status->name ?? '';
    }   

}