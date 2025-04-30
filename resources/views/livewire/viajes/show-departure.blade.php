<div>
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Salidas</h5>
            @livewire('viajes.create-departure')
        </div>


        <div class="card-body">
            <div class="space-x-4 pb-5">
                <input type="text" class="flex-1 border rounded-md px-3 py-1" placeholder="Buscar..." wire:model.live="search">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-stone-50 uppercase bg-blue-900">
                        <tr>
                            <th scope="col" class="px-6 py-3">Institución</th>
                            <th scope="col" class="px-6 py-3">Código Postal</th>
                            <th scope="col" class="px-6 py-3">Estado</th>
                            <th scope="col" class="px-6 py-3">Localidad</th>
                            <th scope="col" class="px-6 py-3">Barrio</th>
                            <th scope="col" class="px-6 py-3">Calle</th>
                            <th scope="col" class="px-6 py-3">Número</th>
                            <th scope="col" class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr class="bg-white even:bg-gray-50 border-b text-gray-900">
                            <td class="px-6 py-3 border">{{ $item->departure }}</td>
                            <td class="px-6 py-3 border">{{ $item->zip_code }}</td>
                            <td class="px-6 py-3 border">{{ $item->state }}</td>
                            <td class="px-6 py-3 border">{{ $item->locality }}</td>
                            <td class="px-6 py-3 border">{{ $item->neighborhood }}</td>
                            <td class="px-6 py-3 border">{{ $item->street }}</td>
                            <td class="px-6 py-3 border">{{ $item->number }}</td>
                            <td class="px-6 py-3 border">
                                <x-danger-button wire:click.prevent="deleteConfirmation({{$item -> id}})"> <i class='bx bxs-trash text-xl'></i></x-danger-button>
                                <x-secondary-button wire:click="editDeparture({{$item->id}})" class="bg-yellow-400 hover:bg-yellow-600"><i class='bx bxs-edit text-xl'></i></x-secondary-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="py-3">
                {{$data->links()}}
            </div>

            <x-dialog-modal wire:model="openEditDeparture">
                <x-slot name="title">Editar punto de salida </x-slot>
                <form wire:submit="updateDeparture">
                    <x-slot name="content">
                        <x-validation-errors class="mb-4" />
                        <div>
                            <x-label for="editInstitution" value="Institución" />
                            <x-input class="block mt-1 w-full" wire:model="departureEdit.departure" type="text" id="editInstitution" oninput="this.value = this.value.toUpperCase()" required autofocus />
                        </div>
                        <div>
                            <x-label for="editZipCode" value="Código Postal" />
                            <div class="flex">
                                <x-input class="block mt-1 w-full" wire:model="departureEdit.zip_code" type="text" id="editZipCode" required autofocus />
                                <x-button wire:click.prevent="fetchCopomexInfo" class="ml-2">Consultar</x-button>
                            </div>
                        </div>
                        <div>
                            <x-label for="editState" value="Estado" />
                            <x-input class="block mt-1 w-full" wire:model="departureEdit.state" type="text" id="editState" oninput="this.value = this.value.toUpperCase()" required autofocus />
                        </div>
                        <div>
                            <x-label for="editLocality" value="Localidad" />
                            <x-input class="block mt-1 w-full" wire:model="departureEdit.locality" type="text" id="editLocality" oninput="this.value = this.value.toUpperCase()" required autofocus />
                        </div>
                        <div>
                            <x-label for="editNeighborhood" value="Vecindario" />
                            <select wire:model="departureEdit.neighborhood" id="editNeighborhood" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona una colonia</option>
                                @foreach ($neighborhoods as $neighborhood)
                                <option value="{{ $neighborhood }}">{{ $neighborhood }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div>
                            <x-label for="editStreet" value="Calle" />
                            <x-input class="block mt-1 w-full" wire:model="departureEdit.street" type="text" id="editStreet" oninput="this.value = this.value.toUpperCase()" required autofocus />
                        </div>
                        <div>
                            <x-label for="editNumber" value="Número" />
                            <x-input class="block mt-1 w-full" wire:model="departureEdit.number" type="number" id="editNumber" required autofocus />
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-danger-button wire:click="$set('openEditDeparture', false)" class="ms-4">
                            {{ __('Cancelar') }}
                        </x-danger-button>
                        <x-button wire:click="updateDeparture" type="submit" class="ms-4">
                            {{ __('Actualizar') }}
                        </x-button>
                    </x-slot>
                </form>

            </x-dialog-modal>

        </div>
    </div>
</div>