<div>
    <div>
        <x-button class="text-white text-sm" wire:click="$set('open' , true)"><i class='bx bxs-plus-square pr-1'></i>Nuevo Modelo</x-button>

        <x-dialog-modal wire:model="open">
            <x-slot name="title">Crear modelo</x-slot>
            <x-slot name="content">
                <x-validation-errors class="mb-4" />
                <div>
                    <x-label for="createModel" value="Modelo" />
                    <x-input class="block mt-1 w-full" wire:model.live="model" type="text" id="createModel" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                </div>
                <div>
                    <x-label for="createYear" value="Año" />
                    <x-input class="block mt-1 w-full" wire:model.live="year" type="number" id="createYear" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                </div>
                <div>
                    <x-label for="brandSelectCreate" value="Marca" />
                    <select wire:model.live="brand" id="brandSelectCreate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecciona una marca</option>
                        @foreach ($brands_select as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
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