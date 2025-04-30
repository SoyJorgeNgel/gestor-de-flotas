{{--Card de modelos de tractores--}}
<div class="w-4/6">
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Modelo de tractor</h5>
            @if(Auth::user()->role_id == '1')
            @livewire('tractores.create-models')
            @endif

        </div>


        <div class="card-body">
            <div class="space-x-4 pb-5">
                <input type="text" class="flex-1 border rounded-md px-3 py-1" placeholder="Buscar..." wire:model.live="search">
            </div>


            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-stone-50 uppercase bg-blue-900">
                    <tr>
                        <th scope="col" class="px-6 py-3">Modelo</th>
                        <th scope="col" class="px-6 py-3">Año</th>
                        <th scope="col" class="px-6 py-3">Marca</th>
                        @if(Auth::user()->role_id == '1')
                        <th scope="col" class="px-6 py-3">Acciones</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach($truck_models as $models)
                    <tr class="bg-white even:bg-gray-50 border-b text-gray-900">

                        <td class="px-6 py-3 border">{{$models->model ?? ''}}</td>
                        <td class="px-6 py-3 border">{{$models->year ?? ''}}</td>
                        <td class="px-6 py-3 border">{{$models->truck_brand->name ?? ''}}</td>
                        @if(Auth::user()->role_id == '1')
                        <td class="px-6 py-3 border">
                            <x-danger-button wire:click="deleteConfirmation({{$models -> id}})"> <i class='bx bxs-trash text-xl'></i></x-danger-button>
                            <x-secondary-button wire:click="editModel({{$models -> id}})" class="bg-yellow-400 hover:bg-yellow-600"><i class='bx bxs-edit text-xl'></i></x-secondary-button>
                        </td>
                        @endif


                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="py-3">
                {{$truck_models->links()}}
            </div>

            <x-dialog-modal wire:model="openEditModel">
                <x-slot name="title">Editar modelo </x-slot>
                <form wire:submit="update">
                    <x-slot name="content">
                        <x-validation-errors class="mb-4" />
                        <div>
                            <x-label for="editModel" value="Modelo" />
                            <x-input class="block mt-1 w-full" wire:model="modelEdit.model" type="text" name="editModel" id="editModel" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                        </div>
                        <div>
                            <x-label for="editYear" value="Año" />
                            <x-input class="block mt-1 w-full" wire:model="modelEdit.year" type="text" name="editYear" id="editYear" :value="old('name')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="name" />
                        </div>
                        <div>
                            <x-label for="brandSelectEdit" value="Marca" />
                            <select wire:model="modelEdit.brand" id="brandSelectEdit" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona una marca</option>
                                @foreach ($brands_select as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-danger-button wire:click="$set('openEditModel' , false)" class="ms-4">
                            {{ __('Cancelar') }}
                        </x-danger-button>
                        <x-button wire:click="updateModel" type="submit" class="ms-4">
                            {{ __('Actualizar') }}
                        </x-button>
                    </x-slot>
                </form>
            </x-dialog-modal>

        </div>
    </div>

</div>