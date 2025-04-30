<div>
    <x-button class="text-white text-sm" wire:click="$set('open' , true)"><i class='bx bxs-plus-circle pr-1' ></i>Nuevo tipo</x-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">Crear tipo de caja</x-slot>
        <x-slot name="content">
            <x-validation-errors class="mb-4" />
            <div>
                <x-label for="name" value="{{ __('Tipo de caja') }}" />
                <x-input class="block mt-1 w-full" wire:model.live="name" type="text" id="name_reg" name="name" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$set('open' , false)" class="ms-4">
                {{ __('Cancelar') }}
            </x-danger-button>
            <x-button wire:click="register"  class="ms-4">
                {{ ('Registrar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
