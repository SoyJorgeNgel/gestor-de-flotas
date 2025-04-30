<?php

namespace App\Livewire\Viajes;

use App\Models\Box;
use App\Models\Cajas\Box_cargo;
use App\Models\Cajas\Box_type;
use App\Models\Departure;
use App\Models\Destination;
use App\Models\RouteLog;
use App\Models\Tractor;
use App\Models\Travels;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateTravel extends Component
{
    public $open = false;
    public $departure_id, $invoiceDate, $departureDate, $departureTime, $returnDate, $returnTime,
        $userId, $tractorId, $box_cargo_id, $boxTypeId, $boxId, $quantity, $freightCost, $boothCost, $expense, $kmTraveled;
    public $departure_select, $user_select, $tractors = [], $box_cargo_select, $box_type_select, $box_select = [], $destination_select;
    public $campos = [];

    public function agregarCampos()
    {
        $this->campos[] = [
            'numero_embarque' => '',
            'destino' => '',
        ];
    }
    public function eliminarCampo($index)
    {
        // Si solo hay un conjunto de campos, no permitir la eliminación
        if (count($this->campos) == 1) {
            return;
        }

        unset($this->campos[$index]);
        $this->campos = array_values($this->campos); // Reindexar el arreglo
    }

    public function mount()
    {
        $this->departure_select = Departure::all();
        $this->user_select = User::where('role_id', 3)->get();
        $this->tractors = collect();
        $this->box_cargo_select = Box_cargo::all();
        $this->box_type_select = Box_type::all();
        $this->box_select = collect();
        $this->destination_select = Destination::all();
        if (empty($this->campos)) {
            $this->agregarCampos();
        }
    }
    public function boot()
    {
        Validator::extend('valid_departure_return', function ($attribute, $value, $parameters, $validator) {
            $departureDateTime = $validator->getData()['departureDate'] . ' ' . $validator->getData()['departureTime'];
            $returnDateTime = $validator->getData()['returnDate'] . ' ' . $validator->getData()['returnTime'];

            return strtotime($departureDateTime) < strtotime($returnDateTime);
        });

        Validator::replacer('valid_departure_return', function ($message, $attribute, $rule, $parameters) {
            return "La fecha y hora de retorno deben ser posteriores a la fecha y hora de salida.";
        });

        Validator::extend('available_tractor', function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            $departureDateTime = $data['departureDate'] . ' ' . $data['departureTime'];
            $returnDateTime = $data['returnDate'] . ' ' . $data['returnTime'];

            $overlappingTravels = Travels::where('tractor_id', $value)
                ->where(function ($query) use ($departureDateTime, $returnDateTime) {
                    $query->whereBetween('departureDate', [$departureDateTime, $returnDateTime])
                        ->orWhereBetween('returnDate', [$departureDateTime, $returnDateTime])
                        ->orWhere(function ($query) use ($departureDateTime, $returnDateTime) {
                            $query->where('departureDate', '<', $departureDateTime)
                                ->where('returnDate', '>', $returnDateTime);
                        });
                })
                ->exists();

            return !$overlappingTravels;
        });

        Validator::replacer('available_tractor', function ($message, $attribute, $rule, $parameters) {
            return "El tractor seleccionado no está disponible en el rango de fechas y horas especificado.";
        });

        Validator::extend('available_box', function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            $departureDateTime = $data['departureDate'] . ' ' . $data['departureTime'];
            $returnDateTime = $data['returnDate'] . ' ' . $data['returnTime'];

            $overlappingTravels = Travels::where('box_id', $value)
                ->where(function ($query) use ($departureDateTime, $returnDateTime) {
                    $query->whereBetween('departureDate', [$departureDateTime, $returnDateTime])
                        ->orWhereBetween('returnDate', [$departureDateTime, $returnDateTime])
                        ->orWhere(function ($query) use ($departureDateTime, $returnDateTime) {
                            $query->where('departureDate', '<', $departureDateTime)
                                ->where('returnDate', '>', $returnDateTime);
                        });
                })
                ->exists();

            return !$overlappingTravels;
        });

        Validator::replacer('available_box', function ($message, $attribute, $rule, $parameters) {
            return "La caja seleccionada no está disponible en el rango de fechas y horas especificado.";
        });

        Validator::extend('available_user', function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            $departureDateTime = $data['departureDate'] . ' ' . $data['departureTime'];
            $returnDateTime = $data['returnDate'] . ' ' . $data['returnTime'];

            $overlappingTravels = Travels::where('user_id', $value)
                ->where(function ($query) use ($departureDateTime, $returnDateTime) {
                    $query->whereBetween('departureDate', [$departureDateTime, $returnDateTime])
                        ->orWhereBetween('returnDate', [$departureDateTime, $returnDateTime])
                        ->orWhere(function ($query) use ($departureDateTime, $returnDateTime) {
                            $query->where('departureDate', '<', $departureDateTime)
                                ->where('returnDate', '>', $returnDateTime);
                        });
                })
                ->exists();

            return !$overlappingTravels;
        });

        Validator::replacer('available_user', function ($message, $attribute, $rule, $parameters) {
            return "El chofer seleccionado no está disponible en el rango de fechas y horas especificado.";
        });
    }
    public function updatedUserId($id)
    {
        $this->tractors = Tractor::where('user_id', $id)->get();
        $this->tractorId = $this->tractors->first()->id ?? null;
    }

    public function updatedBoxTypeId($id)
    {
        $this->box_select = Box::where('box_type_id', $id)->get();
        $this->boxId = $this->box_select->first()->id ?? null;
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
        return view('livewire.viajes.create-travel');
    }
    protected $messages = [
        'departure_id.required' => 'El punto de salida es obligatorio.',
        'departure_id.integer' => 'El punto de salida debe ser un número entero.',
        'invoiceDate.required' => 'La fecha de factura es obligatoria.',
        'invoiceDate.date' => 'La fecha de factura debe ser una fecha válida.',
        'departureDate.required' => 'La fecha de salida es obligatoria.',
        'departureDate.date' => 'La fecha de salida debe ser una fecha válida.',
        'departureTime.required' => 'La hora de salida es obligatoria.',
        'departureTime.date_format' => 'La hora de salida debe tener el formato HH:MM.',
        'returnDate.required' => 'La fecha de retorno es obligatoria.',
        'returnDate.date' => 'La fecha de retorno debe ser una fecha válida.',
        'returnDate.valid_departure_return' => 'La fecha de retorno debe ser posterior a la fecha de salida.',
        'returnTime.required' => 'La hora de retorno es obligatoria.',
        'returnTime.date_format' => 'La hora de retorno debe tener el formato HH:MM.',
        'userId.required' => 'El chofer es obligatorio.',
        'userId.integer' => 'El chofer debe ser un número entero.',
        'tractorId.required' => 'El tractor es obligatorio.',
        'tractorId.integer' => 'El tractor debe ser un número entero.',
        'box_cargo_id.required' => 'El tipo de carga es obligatorio.',
        'box_cargo_id.integer' => 'El tipo de carga debe ser un número entero.',
        'boxTypeId.required' => 'El tipo de caja es obligatorio.',
        'boxTypeId.integer' => 'El tipo de caja debe ser un número entero.',
        'boxId.required' => 'La caja es obligatoria.',
        'boxId.integer' => 'La caja debe ser un número entero.',
        'quantity.numeric' => 'La cantidad debe ser un número.',
        'freightCost.numeric' => 'El costo del flete debe ser un número.',
        'boothCost.numeric' => 'El costo del peaje debe ser un número.',
        'expense.numeric' => 'El gasto debe ser un número.',
        'kmTraveled.numeric' => 'Los kilómetros recorridos deben ser un número.',
        'campos.*.numero_embarque.required' => 'El número de embarque es obligatorio.',
        'campos.*.destino.required' => 'El destino es obligatorio.',
    ];

    public function register()
{
    $validateData = $this->validate([
        'departure_id' => 'required|integer',
        'invoiceDate' => 'required|date',
        'departureDate' => 'required|date',
        'departureTime' => 'required|date_format:H:i',
        'returnDate' => 'required|date|valid_departure_return',
        'returnTime' => 'required|date_format:H:i',
        'userId' => 'required|integer|available_user',
        'tractorId' => 'required|integer|available_tractor',
        'box_cargo_id' => 'required|integer',
        'boxTypeId' => 'required|integer',
        'boxId' => 'required|integer|available_box',
        'quantity' => 'nullable|numeric',
        'freightCost' => 'nullable|numeric',
        'boothCost' => 'nullable|numeric',
        'expense' => 'nullable|numeric',
        'kmTraveled' => 'nullable|numeric',
        'campos.*.numero_embarque' => 'required',
        'campos.*.destino' => 'required',
    ]);

    $newTravel = Travels::create([
        'departure_id' => $validateData['departure_id'],
        'invoiceDate' => $validateData['invoiceDate'],
        'departureDate' => $validateData['departureDate'],
        'departureTime' => $validateData['departureTime'],
        'returnDate' => $validateData['returnDate'],
        'returnTime' => $validateData['returnTime'],
        'user_id' => $validateData['userId'],
        'tractor_id' => $validateData['tractorId'],
        'box_cargo_id' => $validateData['box_cargo_id'],
        'box_type_id' => $validateData['boxTypeId'],
        'box_id' => $validateData['boxId'],
        'quantity' => $validateData['quantity'],
        'freightCost' => $validateData['freightCost'],
        'boothCost' => $validateData['boothCost'],
        'expense' => $validateData['expense'],
        'kmTraveled' => $validateData['kmTraveled'],
        'status_id' => 1
    ]);

    $newTravelId = $newTravel->id;

    foreach ($validateData['campos'] as $campo) {
        RouteLog::create([
            'travel_id' => $newTravelId,
            'numberShipment' => $campo['numero_embarque'],
            'destination_id' => $campo['destino'],
        ]);
    }

    $travelCreate = "El viaje se ha creado";
    $this->dispatch('travel-created');
    $this->dispatch('alert', $travelCreate);

    $this->reset([
        'open',
        'departure_id',
        'invoiceDate',
        'departureDate',
        'departureTime',
        'returnDate',
        'returnTime',
        'userId',
        'tractorId',
        'box_cargo_id',
        'boxTypeId',
        'boxId',
        'quantity',
        'freightCost',
        'boothCost',
        'expense',
        'kmTraveled'
    ]);
}
}
