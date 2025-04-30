<div>
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Viajes</h5>
            @if(Auth::user()->role_id != '3')
            @livewire('viajes.create-travel')
            @endif

        </div>


        <div class="card-body">
            <div class="space-x-4 pb-5">
                <input type="text" class="flex-1 border rounded-md px-3 py-1" placeholder="Buscar..." wire:model.live="search">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-stone-50 uppercase bg-blue-900">
                        <tr>
                            <th scope="col" class="px-6 py-3">Sucursal</th>
                            <th scope="col" class="px-6 py-3">Factura</th>
                            <th scope="col" class="px-6 py-3">Salida</th>
                            <th scope="col" class="px-6 py-3">hr salida</th>
                            <th scope="col" class="px-6 py-3">retorno</th>
                            <th scope="col" class="px-6 py-3">hr retorno</th>
                            <th scope="col" class="px-6 py-3">chofer</th>
                            <th scope="col" class="px-6 py-3">tractor</th>
                            <th scope="col" class="px-6 py-3">caja</th>
                            <th scope="col" class="px-6 py-3">cantidad</th>
                            <th scope="col" class="px-6 py-3">Estado</th>
                            <th scope="col" class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr class="bg-white even:bg-gray-50 border-b text-gray-900">

                            <td class="px-6 py-3 border">{{ $item->departure->departure ?? '' }}</td>
                            <td class="px-6 py-3 border">{{ $item->invoiceDate ?? '' }}</td>
                            <td class="px-6 py-3 border">{{ $item->departureDate ?? '' }}</td>
                            <td class="px-6 py-3 border">{{ $item->departureTime ?? '' }}</td>
                            <td class="px-6 py-3 border">{{ $item->returnDate ?? '' }}</td>
                            <td class="px-6 py-3 border">{{ $item->returnTime ?? '' }}</td>
                            <td class="px-6 py-3 border">{{ ($item->user->name ?? '') . ' ' . ($item->user->paternalSurname ?? '') . ' ' . ($item->user->maternalSurname ?? '') }}</td>
                            <td class="px-6 py-3 border">{{ $item->tractor->plate ?? '' }}</td>
                            <td class="px-6 py-3 border">{{ $item->box->plate ?? '' }}</td>
                            <td class="px-6 py-3 border">{{ $item->quantity ?? '' }}</td>
                            <td class="px-6 py-3 border">{{ $item->status->name ?? '' }}</td>

                            <td class="px-6 py-3 border">
                                <div class="flex space-x-2 items-center">
                                    <!-- Formulario para el reporte -->
                                    <form action="{{ route('viajes.reporte') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="viaje_id" value="{{ $item->id}}">
                                        <x-secondary-button type="submit" class="bg-gray-200 hover:bg-gray-50">
                                            <i class='bx bxs-file-pdf text-red-500 text-xl'></i>
                                        </x-secondary-button>
                                    </form>

                                    <!-- Botón de información -->
                                    <x-secondary-button wire:click="info({{ $item->id }})" class="bg-cyan-400 hover:bg-cyan-600">
                                        <i class='bx bxs-info-circle text-xl'></i>
                                    </x-secondary-button>
                                    @if(Auth::user()->role_id == '1')
                                    <!-- Botón de eliminación -->
                                    <x-danger-button wire:click.prevent="deleteConfirmation({{ $item->id }})">
                                        <i class='bx bxs-trash text-xl'></i>
                                    </x-danger-button>
                                    @endif

                                    @if(Auth::user()->role_id != '3')
                                    <!-- Botón de edición -->
                                    <x-secondary-button wire:click="edit({{ $item->id }})" class="bg-yellow-400 hover:bg-yellow-600">
                                        <i class='bx bxs-edit text-xl'></i>
                                    </x-secondary-button>
                                    @endif

                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <x-dialog-modal wire:model="open" maxWidth="4xl">
                <x-slot name="title">Informacion del viaje</x-slot>
                <x-slot name="content">
                    <div class="grid grid-cols-3 gap-4 pb-4">
                        <div>
                            <p><strong>Punto de salida:</strong> {{ $travelinfo['departure_id'] ?? '' }}</p>
                            <p><strong>Fecha de factura:</strong> {{ $travelinfo['invoiceDate'] ?? '' }}</p>
                            <p><strong>Chofer:</strong> {{ $travelinfo['user_id'] ?? '' }}</p>
                            <p><strong>Cantidad:</strong> {{ $travelinfo['quantity'] ?? '' }}</p>
                            <p><strong>Costo del flete:</strong> {{ $travelinfo['freightCost'] ?? '' }}</p>
                        </div>
                        <div>
                            <p><strong>Fecha de salida:</strong> {{ $travelinfo['departureDate'] ?? '' }}</p>
                            <p><strong>Hora de salida:</strong> {{ $travelinfo['departureTime'] ?? '' }}</p>
                            <p><strong>Tractor:</strong> {{ $travelinfo['tractor_id'] ?? '' }}</p>
                            <p><strong>Tipo de carga:</strong> {{ $travelinfo['box_cargo_id'] ?? '' }}</p>
                            <p><strong>Costo del peaje:</strong> {{ $travelinfo['boothCost'] ?? '' }}</p>
                            <p><strong>Kilómetros recorridos:</strong> {{ $travelinfo['kmTraveled'] ?? '' }}</p>
                        </div>
                        <div>
                            <p><strong>Fecha de retorno:</strong> {{ $travelinfo['returnDate'] ?? '' }}</p>
                            <p><strong>Hora de retorno:</strong> {{ $travelinfo['returnTime'] ?? '' }}</p>
                            <p><strong>Tipo de caja:</strong> {{ $travelinfo['box_type_id'] ?? '' }}</p>
                            <p><strong>Caja:</strong> {{ $travelinfo['box_id'] ?? '' }}</p>
                            <p><strong>Gasto:</strong> {{ $travelinfo['expense'] ?? '' }}</p>
                            <p><strong>Estatus:</strong> {{ $travelinfo['status'] ?? '' }}</p>
                        </div>
                    </div>


                    @livewire('viajes.show-travel-destination', ['travelId' => $travelinfo['travelId']], key($travelinfo['travelId']))


                </x-slot>
                <x-slot name="footer">
                    <x-danger-button wire:click="$set('open' , false)" class="ms-4">
                        {{ ('Cerrar') }}
                    </x-danger-button>
                </x-slot>
            </x-dialog-modal>
            <div class="py-3">
                {{$data->links()}}
            </div>

        </div>
    </div>
</div>