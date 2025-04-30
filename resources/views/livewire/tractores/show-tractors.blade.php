<div>
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Tractores</h5>
            @if(Auth::user()->role_id == '1')
            @livewire('tractores.create-tractors')
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
                            <th scope="col" class="px-6 py-3">N.º de Serie del motor</th>
                            <th scope="col" class="px-6 py-3">Modelo</th>
                            <th scope="col" class="px-6 py-3">Placa</th>
                            <th scope="col" class="px-6 py-3">Kilometraje</th>
                            <th scope="col" class="px-6 py-3">Chofer</th>
                            @if(Auth::user()->role_id == '1')
                            <th scope="col" class="px-6 py-3">Acciones</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tractors as $t)
                        <tr class="bg-white even:bg-gray-50 border-b text-gray-900">
                            <td class="px-6 py-3 border">{{$t->serialNumber ?? ''}}</td>
                            <td class="px-6 py-3 border">{{($t->truck_model->model ?? '') . ' ' . ($t->truck_model->year ?? '')}}</td>
                            <td class="px-6 py-3 border">{{$t->plate ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$t->mileage ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$t->user->name." ".$t->user->paternalSurname." ".$t->user->maternalSurname ?? ''}}</td>
                            @if(Auth::user()->role_id == '1')
                            <td class="px-6 py-3 border">
                                <x-danger-button wire:click.prevent="deleteConfirmation({{$t -> id}})"> <i class='bx bxs-trash text-xl'></i></x-danger-button>
                                <x-secondary-button wire:click="editTractor({{$t -> id}})" class="bg-yellow-400 hover:bg-yellow-600"><i class='bx bxs-edit text-xl'></i></x-secondary-button>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="py-3">
                {{$tractors->links()}}
            </div>

            <x-dialog-modal wire:model="openEditTractor">
                <x-slot name="title">Editar tractor </x-slot>
                <form wire:submit="updateTractor">
                    <x-slot name="content">
                        <x-validation-errors class="mb-4" />
                        <div>
                            <x-label for="editSerialNumber" value="Numero de serie del motor" />
                            <x-input class="block mt-1 w-full" wire:model.live="tractorEdit.serialNumber" type="text" id="editSerialNumber" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                        </div>
                        <div>
                            <x-label for="modelSelectCreate" value="Modelo" />
                            <select wire:model.live="tractorEdit.truck_model_id" id="modelSelectCreate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona un modelo</option>
                                @foreach ($models_select as $model)
                                <option value="{{ $model->id }}">{{ $model->model . " " . $model->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="createPlate" value="Placa" />
                            <x-input class="block mt-1 w-full" wire:model.live="tractorEdit.plate" type="text" id="createPlate" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                        </div>
                        <div>
                            <x-label for="createMileage" value="Kilometraje" />
                            <x-input class="block mt-1 w-full" wire:model.live="tractorEdit.mileage" type="number" id="createMileage" :value="old('name')" required autofocus autocomplete="name" />
                        </div>
                        <div>
                            <x-label for="userSelectCreate" value="Usuario" />
                            <select wire:model.live="tractorEdit.user_id" id="userSelectCreate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona un Usuario</option>
                                @foreach ($users_select as $user)
                                <option value="{{ $user->id }}">{{ $user->name." ".$user->paternalSurname." ".$user->maternalSurname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-danger-button wire:click="$set('openEditTractor' , false)" class="ms-4">
                            {{ __('Cancelar') }}
                        </x-danger-button>
                        <x-button wire:click="updateTractor" type="submit" class="ms-4">
                            {{ ('Actualizar') }}
                        </x-button>
                    </x-slot>
                </form>
            </x-dialog-modal>
        </div>
    </div>
</div>