{{--Card de marcas de tractores--}}
<div class="w-2/6">
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Marcas</h5>
            @if(Auth::user()->role_id == '1')
            @livewire('tractores.create-brands')
            @endif

        </div>


        <div class="card-body">
            <div class="space-x-4 pb-5">
                <input type="text" class="flex-1 border rounded-md px-3 py-1" name="searchBrands" placeholder="Buscar..." wire:model.live="search">
            </div>



            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-stone-50 uppercase bg-blue-900">
                    <tr>
                        <th scope="col" class="px-6 py-3">Marca</th>
                        @if(Auth::user()->role_id == '1')
                        <th scope="col" class="px-6 py-3">Acciones</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach($truck_brands as $brands)
                    <tr class="bg-white even:bg-gray-50 border-b text-gray-900">
                        <td class="px-6 py-3 border">{{$brands -> name}}</td>
                        @if(Auth::user()->role_id == '1')
                        <td class="px-6 py-3 border">
                            <x-danger-button wire:click.prevent="deleteConfirmation({{$brands -> id}})"> <i class='bx bxs-trash text-xl'></i></x-danger-button>
                            <x-secondary-button wire:click="editBrand({{$brands -> id}})" class="bg-yellow-400 hover:bg-yellow-600"><i class='bx bxs-edit text-xl'></i></x-secondary-button>
                        </td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="py-3">
                {{$truck_brands->links()}}
            </div>

            <x-dialog-modal wire:model="openEditBrand">
                <x-slot name="title">Editar modelo </x-slot>
                <form wire:submit="update">
                    <x-slot name="content">
                        <x-validation-errors class="mb-4" />
                        <div>
                            <x-label for="nameEdit" value="Nombre de la marca" />
                            <x-input class="block mt-1 w-full" wire:model="brandEdit.name" type="text" name="nameEdit" id="nameEdit" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-danger-button wire:click="$set('openEditBrand' , false)" class="ms-4">
                            {{ __('Cancelar') }}
                        </x-danger-button>
                        <x-button wire:click="updateBrand" type="submit" class="ms-4">
                            {{ __('Actualizar') }}
                        </x-button>
                    </x-slot>
                </form>
            </x-dialog-modal>

        </div>
    </div>

</div>