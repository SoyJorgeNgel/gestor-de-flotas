<div>
    <div>
        <x-button class="text-white text-sm" wire:click="$set('open' , true)"><i class='bx bxs-truck pr-1' ></i>Nuevo Tractor</x-button>

        <x-dialog-modal wire:model="open">
            <x-slot name="title">Crear tractor</x-slot>
            <x-slot name="content">
                <x-validation-errors class="mb-4" />
                <div>
                    <x-label for="createSerialNumber" value="Numero de serie del motor" />
                    <x-input class="block mt-1 w-full" wire:model.live="serialNumber" type="text" id="createSerialNumber" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                </div>
                <div>
                    <x-label for="modelSelectCreate" value="Modelo" />
                    <select wire:model.live="truck_model_id" id="modelSelectCreate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecciona un modelo</option>
                        @foreach ($models_select as $model)
                        <option value="{{ $model->id }}">{{ $model->model . " " . $model->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-label for="createPlate" value="Placa" />
                    <x-input class="block mt-1 w-full" wire:model.live="plate" type="text" id="createPlate" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                </div>
                <div>
                    <x-label for="createMileage" value="Kilometraje" />
                    <x-input class="block mt-1 w-full" wire:model.live="mileage" type="number" id="createMileage" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                <div>
                    <x-label for="userSelectCreate" value="Usuario" />
                    <select wire:model.live="user_id" id="userSelectCreate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecciona un Usuario</option>
                        @foreach ($users_select as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-danger-button wire:click="$set('open' , false)" class="ms-4">
                    {{ __('Cancelar') }}
                </x-danger-button>
                <x-button wire:click="register" class="ms-4">
                    {{ ('Registrar') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </div>

</div>