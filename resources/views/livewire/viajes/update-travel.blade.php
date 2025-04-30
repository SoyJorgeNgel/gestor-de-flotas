<div>
    <div class="card-header mb-4">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Editar viaje {{$travel-> id}}</h5>
        </div>
        <div class="card-body">
            <div class="w-full">
                <x-validation-errors class="mb-4" />
                <p class="mb-1">*Campos obligatorios</p>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="departure" value="*Sucursal" />
                        <select wire:model.live="departure_id" id="departureSelectCreate" value="{{$travel-> departure_id}}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecciona la salida</option>
                            @foreach ($departure_select as $departure)
                            <option value="{{ $departure->id }}">{{ $departure->departure }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="invoiceDate" value="*Fecha de factura" />
                        <x-input class="block mt-1 w-full" wire:model="invoiceDate" type="date" id="invoiceDate" required autofocus />
                    </div>
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="departureDate" value="*Fecha de salida" />
                        <x-input class="block mt-1 w-full" wire:model="departureDate" type="date" id="departureDate" required autofocus />
                    </div>
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="departureTime" value="*Hora de salida" />
                        <x-input class="block mt-1 w-full" wire:model="departureTime" type="time" id="departureTime" required autofocus />
                    </div>
                </div>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="returnDate" value="*Fecha de retorno" />
                        <x-input class="block mt-1 w-full" wire:model="returnDate" type="date" id="returnDate" required autofocus />
                    </div>
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="returnTime" value="*Hora de retorno" />
                        <x-input class="block mt-1 w-full" wire:model="returnTime" type="time" id="returnTime" required autofocus />
                    </div>
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="user_id" value="*Chofer" />
                        <select wire:model.live="userId" id="user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecciona un chofer</option>
                            @foreach ($user_select as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="tractor_id" value="*Tractor" />
                        <select wire:model.live="tractor_id" id="tractor_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @if($tractors -> count() == 0)
                            <option value="">Seleccione un chofer</option>
                            @endif
                            @foreach ($tractors as $tractor)
                            <option value="{{ $tractor->id }}">{{ $tractor->plate }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="box_cargo_id" value="*Tipo de carga" />
                        <select wire:model.live="box_cargo_id" id="box_cargo_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecciona la carga</option>
                            @foreach ($box_cargo_select as $box_cargo)
                            <option value="{{ $box_cargo->id }}">{{ $box_cargo->cargo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="box_type_id" value="*Tipo de caja" />
                        <select wire:model.live="boxTypeId" id="box_type_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecciona el tipo de caja</option>
                            @foreach ($box_type_select as $box_type)
                            <option value="{{ $box_type->id }}">{{ $box_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="box_id" value="*Caja" />
                        <select wire:model.live="boxId" id="box_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @if($box_select -> count() == 0)
                            <option value="">Seleccione un tipo</option>
                            @endif
                            @foreach ($box_select as $box)
                            <option value="{{ $box->id }}">{{ $box->plate }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="w-full md:w-1/4 px-4">
                        <x-label for="quantity" value="Cantidad" />
                        <x-input class="block mt-1 w-full" wire:model="quantity" type="number" id="quantity" required autofocus />
                    </div>
                </div>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/5 px-4">
                        <x-label for="freightCost" value="Costo de flete" />
                        <x-input class="block mt-1 w-full" wire:model.live="freightCost" type="number" id="freightCost" required autofocus />
                    </div>
                    <div class="w-full md:w-1/5 px-4">
                        <x-label for="boothCost" value="Costo de caseta" />
                        <x-input class="block mt-1 w-full" wire:model.live="boothCost" type="number" id="boothCost" required autofocus />
                    </div>
                    <div class="w-full md:w-1/5 px-4">
                        <x-label for="expense" value="Gastos" />
                        <x-input class="block mt-1 w-full" wire:model.live="expense" type="number" id="expense" required autofocus />
                    </div>
                    <div class="w-full md:w-1/5 px-4">
                        <x-label for="kmTraveled" value="Km recorridos" />
                        <x-input class="block mt-1 w-full" wire:model="kmTraveled" type="number" id="kmTraveled" required autofocus />
                    </div>
                    <div class="w-full md:w-1/5 px-4">
                        <x-label for="status_id" value="*Estado" />
                        <select wire:model.live="status_id" id="status_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($status_select as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="py-3">
                    <a href="/viajes"><x-danger-button>
                            {{ __('Cancelar') }}
                        </x-danger-button></a>
                    <x-secondary-button wire:click="update" class="bg-indigo-700 hover:bg-indigo-950 text-white">
                        {{ __('Update') }}
                    </x-secondary-button>
                </div>

            </div>
        </div>
    </div>

    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Destinos del viaje {{$travel-> id}}</h5>
            @livewire('viajes.create-travel-destination', [
                'travelId' => $travel->id
                ])
        </div>
        <div class="card-body">
            <div class="w-full">
                @livewire('viajes.show-travel-destination', ['travelId' => $travel->id])
            </div>
        </div>
    </div>
</div>