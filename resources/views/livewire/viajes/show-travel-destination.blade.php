<div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-stone-50 uppercase bg-blue-900">
            <tr>
                <th scope="col" class="px-6 py-3">Numero de embarque</th>
                <th scope="col" class="px-6 py-3">Destino</th>
                @if(Auth::user()->role_id != '3')
                <th scope="col" class="px-6 py-3">Acciones</th>
                @endif

            </tr>
        </thead>
        <tbody>
            @foreach($detinations as $d)
            <tr class="bg-white even:bg-gray-50 border-b text-gray-900">
                <td class="px-6 py-3 border">{{$d -> numberShipment}}</td>
                <td class="px-6 py-3 border">{{$d -> destination -> institution}}</td>
                @if(Auth::user()->role_id != '3')
                <td class="px-6 py-3 border">
                    <x-danger-button wire:click="deleteConfirmation({{$d -> id}})"> <i class='bx bxs-trash text-xl'></i></x-danger-button>
                    <x-secondary-button wire:click="editDestination({{$d -> id}})" class="bg-yellow-400 hover:bg-yellow-600"><i class='bx bxs-edit text-xl'></i></x-secondary-button>
                </td>
                @endif

            </tr>
            @endforeach
        </tbody>
    </table>

    <x-dialog-modal wire:model="openEditDest">
        <x-slot name="title">Editar Destino </x-slot>
        <form wire:submit="update">
            <x-slot name="content">
                <x-validation-errors class="mb-4" />
                <div>
                    <x-label for="editNumberShipment" value="Numero de embarque" />
                    <x-input class="block mt-1 w-full" wire:model="destEdit.numberShipment" type="text" name="editModel" id="editModel" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                <div>
                    <x-label for="destination" value="Destino" />
                    <select wire:model="destEdit.destination_id" id="destination" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecciona un destino</option>
                        @foreach ($dest_select as $d)
                        <option value="{{ $d->id }}">{{ $d->institution }}</option>
                        @endforeach
                    </select>

                </div>
            </x-slot>
            <x-slot name="footer">
                <x-danger-button wire:click="$set('openEditDest' , false)" class="ms-4">
                    {{ __('Cancelar') }}
                </x-danger-button>
                <x-button wire:click="update" type="submit" class="ms-4">
                    {{ __('Actualizar') }}
                </x-button>
            </x-slot>
        </form>
    </x-dialog-modal>
</div>