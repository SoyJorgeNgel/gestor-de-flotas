<div>
    <div>
        <x-button class="text-white text-sm" wire:click="$set('open' , true)"><i class='bx bxs-plus-square pr-1'></i>Nueva marca</x-button>

        <x-dialog-modal wire:model="open">
            <x-slot name="title">Crear marca</x-slot>
            <x-slot name="content">
                <x-validation-errors class="mb-4" />
                <div>
                    <x-label for="createName" value="{{ __('Nombre de la marca') }}" />
                    <x-input class="block mt-1 w-full" wire:model.live="brand" type="text" name="createName" id="createName" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
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