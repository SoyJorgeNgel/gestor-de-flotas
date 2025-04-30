<div>
<div>
        <x-button class="text-white text-sm" wire:click="$set('open' , true)"><i class='bx bxs-map pr-1' ></i>Nuevo Destino</x-button>

        <x-dialog-modal wire:model="open">
        <x-slot name="title">Añadir Destino </x-slot>
            <x-slot name="content">
            <p class="mb-1">*Campos obligatorios</p>
                <x-validation-errors class="mb-4" />
                <div>
                    <x-label for="editNumberShipment" value="*Numero de embarque" />
                    <x-input class="block mt-1 w-full" wire:model="numberShipment" type="text" name="editModel" id="editModel" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                <div>
                <x-label for="destination" value="*Destino" />
                    <select wire:model="destination_id" id="destination" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecciona un destino</option>
                        @foreach ($dest_select as $d)
                        <option value="{{ $d->id }}">{{ $d->institution }}</option>
                        @endforeach
                    </select>

                </div>
            </x-slot>
            <x-slot name="footer">
                <x-danger-button wire:click="$set('open' , false)" class="ms-4">
                    {{ __('Cancelar') }}
                </x-danger-button>
                <x-button wire:click="register" type="submit" class="ms-4">
                    {{ 'Registrar' }}
                </x-button>
            </x-slot>
    </x-dialog-modal>
    </div>
</div>
