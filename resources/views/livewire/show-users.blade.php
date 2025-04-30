<div>
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Usuarios</h5>
            @if(Auth::user()->role_id == '1')
            @livewire('create-users')
            @endif

        </div>


        <div class="card-body">
            <div class="space-x-4 pb-5">
                <input type="text" class="flex-1 border rounded-md px-3 py-1" placeholder="Buscar..." wire:model.live="search" name="search">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-stone-50 uppercase bg-blue-900">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nombre(s)</th>
                            <th scope="col" class="px-6 py-3">A.
                                Paterno</th>
                            <th scope="col" class="px-6 py-3">A.
                                Materno</th>
                            <th scope="col" class="px-6 py-3">E-mail</th>
                            <th scope="col" class="px-6 py-3">TELÉFONO</th>
                            <th scope="col" class="px-6 py-3">Rol</th>
                            @if(Auth::user()->role_id == '1')
                            <th scope="col" class="px-6 py-3">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                        <tr class="bg-white even:bg-gray-50 border-b text-gray-900">
                            <td class="px-6 py-3 border">{{$u->name ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$u->paternalSurname ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$u->maternalSurname ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$u->email ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$u->phoneNumber ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$u->role->role ?? ''}}</td>
                            @if(Auth::user()->role_id == '1')
                            <td class="px-6 py-3 border">
                                <x-danger-button wire:click.prevent="deleteConfirmation({{$u -> id}})"> <i class='bx bxs-trash text-xl'></i></x-danger-button>
                                <x-secondary-button wire:click="edit({{$u->id}})" class="bg-yellow-400 hover:bg-yellow-600"><i class='bx bxs-edit text-xl'></i></x-secondary-button>
                            </td>
                            @endif


                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="py-3">
                {{$users->links()}}
            </div>

            <x-dialog-modal wire:model="open_edit">
                <x-slot name="title">Editar al usuario {{$user->name}}</x-slot>
                <form wire:submit="update">
                    <x-slot name="content">
                    <p class="mb-1">*Campos obligatorios</p>
                        <x-validation-errors class="mb-1" />
                        <div>
                            <x-label for="name" value="{{ __('*Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" wire:model="userEdit.name" type="text" name="name" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                        </div>
                        <div>
                            <x-label for="paternalSurname" value="{{ __('*Apellido paterno') }}" />
                            <x-input id="paternalSurname" class="block mt-1 w-full" wire:model="userEdit.paternalSurname" type="text" name="paternalSurname" :value="old('paternalSurname')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="family-name" />
                        </div>
                        <div>
                            <x-label for="maternalSurname" value="{{ __('*Apellido materno') }}" />
                            <x-input id="maternalSurname" class="block mt-1 w-full" wire:model="userEdit.maternalSurname" type="text" name="maternalSurname" :value="old('maternalSurname')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="family-name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('*Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" wire:model="userEdit.email" type="email" name="email" :value="old('email')" oninput="this.value = this.value.toUpperCase()" required autocomplete="email" />
                        </div>

                        <div class="mt-4">
                            <x-label for="phoneNumber" value="{{ __('Numero de celular') }}" />
                            <x-input id="phoneNumber" class="block mt-1 w-full" wire:model="userEdit.phoneNumber" type="number" name="phoneNumber" :value="old('phoneNumber')" required autocomplete="tel" />
                        </div>
                        <div class="mt-4">
                            <x-label for="roleSelect" value="*Rol" />
                            <select wire:model.live="userEdit.role_id" id="roleSelect" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona un rol</option>
                                @foreach ($role_select as $role)
                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-danger-button wire:click="$set('open_edit' , false)" class="ms-4">
                            {{ 'Cancelar' }}
                        </x-danger-button>
                        <x-button wire:click="update" type="submit" class="ms-4">
                            {{ 'Actualizar' }}
                        </x-button>
                    </x-slot>
                </form>
            </x-dialog-modal>
        </div>
    </div>
</div>