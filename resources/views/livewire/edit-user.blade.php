<div>
    <x-secondary-button wire:click="edit({{$user->id}})" class="bg-yellow-400 hover:bg-yellow-600"><i class='bx bxs-edit text-xl'></i></x-secondary-button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">Editar al usuario {{$user->name}}</x-slot>
        <form wire:submit="update">
            <x-slot name="content">
                <x-validation-errors class="mb-4" />
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" wire:model="userEdit.name" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model="userEdit.email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-danger-button wire:click="$set('open' , false)" class="ms-4">
                    {{ __('Cancelar') }}
                </x-danger-button>
                <x-button wire:click="update" type="submit" class="ms-4">
                    {{ __('update') }}
                </x-button>
            </x-slot>
        </form>
    </x-dialog-modal>
</div>