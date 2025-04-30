<div>
    <x-button class="text-white text-sm" wire:click="$set('open' , true)"><i class='bx bxs-user-plus pr-1'></i>Nuevo usuario</x-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">Crear usuario</x-slot>
        <x-slot name="content">
        <p class="mb-1">*Campos obligatorios</p>
            <x-validation-errors class="mb-1" />
            <div>
                <x-label for="name_reg" value="{{ __('*Name') }}" />
                <x-input class="block mt-1 w-full" wire:model.live="name" type="text" id="name_reg" name="name_reg" oninput="this.value = this.value.toUpperCase()" :value="old('name_reg')" required autofocus autocomplete="name" />
            </div>
            <div>
                <x-label for="paternalSurname_reg" value="{{ __('*Apellido paterno') }}" />
                <x-input class="block mt-1 w-full" wire:model.live="paternalSurname" type="text" id="paternalSurname_reg" name="paternalSurname_reg" oninput="this.value = this.value.toUpperCase()" :value="old('paternalSurname_reg')" required autofocus autocomplete="family-name" />
            </div>
            <div>
                <x-label for="maternalSurname_reg" value="{{ __('*Apellido materno') }}" />
                <x-input class="block mt-1 w-full" wire:model.live="maternalSurname" type="text" id="maternalSurname_reg" name="maternalSurname_reg" oninput="this.value = this.value.toUpperCase()" :value="old('maternalSurname_reg')" required autofocus autocomplete="family-name" />
            </div>

            <div class="mt-2">
                <x-label for="email_reg" value="{{ __('*Email') }}" />
                <x-input class="block mt-1 w-full" wire:model.live="email" type="email" id="email_reg" name="email_reg" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="email" />
            </div>

            <div class="mt-2">
                <x-label for="phoneNumber_reg" value="{{ __('Numero de celular') }}" />
                <x-input class="block mt-1 w-full" wire:model.live="phoneNumber" type="number" id="phoneNumber_reg" name="phoneNumber_reg" :value="old('phoneNumber_reg')" required autofocus autocomplete="tel" />
            </div>

            <div class="mt-2">
                <x-label for="password_reg" value="{{ __('*Password') }}" />
                <x-input class="block mt-1 w-full" wire:model.live="password" type="password" id="password_reg" name="password_reg" required />
            </div>

            <div class="mt-2">
                <x-label for="password_confirmation_reg" value="{{ __('*Confirm Password') }}" />
                <x-input class="block mt-1 w-full" wire:model.live="password_confirmation" id="password_confirmation_reg" type="password" name="password_confirmation_reg" required />
            </div>
            <div class="mt-2">
                <x-label for="roleSelectCreate" value="*Rol" />
                <select wire:model.live="role_id" id="roleSelectCreate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Selecciona un rol</option>
                    @foreach ($role_select as $role)
                    <option value="{{ $role->id }}">{{ $role->role }}</option>
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