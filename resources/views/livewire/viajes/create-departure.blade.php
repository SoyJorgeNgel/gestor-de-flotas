<div>
    <div>
        <x-button class="text-white text-sm" wire:click="$set('open' , true)"><i class='bx bxs-plus-square pr-1'></i>Nueva Salida</x-button>

        <x-dialog-modal wire:model="open">
            <x-slot name="title">Crear punto de salida</x-slot>
            <x-slot name="content">
                <x-validation-errors class="mb-4" />
                <div>
                    <x-label for="createInstitution" value="Institución" />
                    <x-input class="block mt-1 w-full" wire:model="departure" type="text" id="createInstitution" oninput="this.value = this.value.toUpperCase()" required autofocus />
                </div>
                <div>
                    <x-label for="editZipCode" value="Código Postal" />
                    <div class="flex">
                        <x-input class="block mt-1 w-full" wire:model="zip_code" type="text" id="editZipCode" required autofocus />
                        <x-button wire:click.prevent="fetchCopomexInfo" class="ml-2">Consultar</x-button>
                    </div>
                </div>
                <div>
                    <x-label for="createState" value="Estado" />
                    <x-input class="block mt-1 w-full" wire:model.live="state" type="text" id="createState" oninput="this.value = this.value.toUpperCase()" required autofocus />
                </div>
                <div>
                    <x-label for="createLocality" value="Localidad" />
                    <x-input class="block mt-1 w-full" wire:model.live="locality" type="text" id="createLocality" oninput="this.value = this.value.toUpperCase()" required autofocus />
                </div>
                <div>
                    <x-label for="createNeighborhood" value="Vecindario" />
                    <select wire:model="neighborhood" id="editNeighborhood" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecciona una colonia</option>
                        @foreach ($neighborhoods as $neighborhood)
                        <option value="{{ $neighborhood }}">{{ $neighborhood }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-label for="createStreet" value="Calle" />
                    <x-input class="block mt-1 w-full" wire:model="street" type="text" id="createStreet" oninput="this.value = this.value.toUpperCase()" required autofocus />
                </div>
                <div>
                    <x-label for="createNumber" value="Número" />
                    <x-input class="block mt-1 w-full" wire:model="number" type="number" id="createNumber" required autofocus />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-danger-button wire:click="$set('open' , false)" class="ms-4">
                    {{ __('Cancelar') }}
                </x-danger-button>
                <x-button wire:click="register" class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </div>

</div>