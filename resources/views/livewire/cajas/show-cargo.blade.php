{{--Card de tipo de carga--}}
<div class="w-3/6">
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Tipo de carga</h5>@if(Auth::user()->role_id == '1')
            @livewire('cajas.create-cargo')
            @endif

        </div>


        <div class="card-body">
            <div class="space-x-4 pb-5">
                <input type="text" class="flex-1 border rounded-md px-3 py-1" name="searchCargo" placeholder="Buscar..." wire:model.live="search">
            </div>


            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-stone-50 uppercase bg-blue-900">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tipo de carga</th>
                        @if(Auth::user()->role_id == '1')
                        <th scope="col" class="px-6 py-3">Acciones</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach($box_cargo as $cargo)
                    <tr class="bg-white even:bg-gray-50 border-b text-gray-900">
                        <td class="px-6 py-3 border">{{$cargo -> cargo}}</td>
                        @if(Auth::user()->role_id == '1')
                        <td class="px-6 py-3 border">
                            <x-danger-button> <i wire:click="deleteConfirmation({{$cargo -> id}})" class='bx bxs-trash text-xl'></i></x-danger-button>
                            <x-secondary-button wire:click="editCargo({{$cargo -> id}})" class="bg-yellow-400 hover:bg-yellow-600"><i class='bx bxs-edit text-xl'></i></x-secondary-button>
                        </td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="py-3">
                {{$box_cargo->links()}}
            </div>

            <x-dialog-modal wire:model="openEditCargo">
                <x-slot name="title">Editar tamaño </x-slot>
                <form wire:submit="update">
                    <x-slot name="content">
                        <x-validation-errors class="mb-4" />
                        <div>
                            <x-label for="name" value="{{ __('Tipo de carga') }}" />
                            <x-input id="name" class="block mt-1 w-full" wire:model="cargoEdit.cargo" type="text" name="nameCreate" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-danger-button wire:click="$set('openEditCargo' , false)" class="ms-4">
                            {{ __('Cancelar') }}
                        </x-danger-button>
                        <x-button wire:click="updateCargo" type="submit" class="ms-4">
                            {{ __('Actualizar') }}
                        </x-button>
                    </x-slot>
                </form>
            </x-dialog-modal>

        </div>
    </div>

</div>