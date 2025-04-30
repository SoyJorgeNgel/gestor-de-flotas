<div>
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Cajas</h5>
            @if(Auth::user()->role_id == '1')
            @livewire('cajas.create-boxes')
            @endif

        </div>


        <div class="card-body">
            <div class="space-x-4 pb-5">
                <input type="text" class="flex-1 border rounded-md px-3 py-1" placeholder="Buscar..." wire:model.live="search">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-stone-50 uppercase bg-blue-900">
                        <tr>
                            <th scope="col" class="px-6 py-3">Tipo de caja</th>
                            <th scope="col" class="px-6 py-3">Placa</th>
                            <th scope="col" class="px-6 py-3">Tamaño</th>
                            <th scope="col" class="px-6 py-3">Permiso</th>
                            @if(Auth::user()->role_id == '1')
                            <th scope="col" class="px-6 py-3">Acciones</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boxes as $b)
                        <tr class="bg-white even:bg-gray-50 border-b text-gray-900">
                            <td class="px-6 py-3 border">{{$b->box_type->name ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$b->plate ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$b->box_size->name ?? ''}}</td>
                            <td class="px-6 py-3 border">{{$b->box_permit->name ?? ''}}</td>
                            @if(Auth::user()->role_id == '1')
                            <td class="px-6 py-3 border">
                                <x-danger-button wire:click.prevent="deleteConfirmation({{$b -> id}})"> <i class='bx bxs-trash text-xl'></i></x-danger-button>
                                <x-secondary-button wire:click="editBox({{$b -> id}})" class="bg-yellow-400 hover:bg-yellow-600"><i class='bx bxs-edit text-xl'></i></x-secondary-button>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="py-3">
                {{$boxes->links()}}
            </div>

            <x-dialog-modal wire:model="open_edit">
                <x-slot name="title">Editar caja </x-slot>
                <form wire:submit="update">
                    <x-slot name="content">
                        <div>
                            <x-label for="boxTypeSelectEdit" value="Tipo de caja" />
                            <select wire:model.live="boxEdit.boxType" id="boxTypeSelectEdit" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona el tipo de caja</option>
                                @foreach ($boxType_select as $boxType)
                                <option value="{{ $boxType->id }}">{{ $boxType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="plate_reg" value="Placa" />
                            <x-input class="block mt-1 w-full" wire:model.live="boxEdit.plate" type="text" id="plate_reg" name="plate_reg" :value="old('plate_reg')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="plate_reg" />
                        </div>
                        <div>
                            <x-label for="boxSizeSelectEdit" value="Tamaño" />
                            <select wire:model.live="boxEdit.boxSize" id="boxSizeSelectEdit" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona el tamaño</option>
                                @foreach ($boxSize_select as $boxSize)
                                <option value="{{ $boxSize->id }}">{{ $boxSize->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="boxPermitSelectEdit" value="Permiso" />
                            <select wire:model.live="boxEdit.boxPermit" id="boxPermitSelectEdit" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona el permiso</option>
                                @foreach ($boxPermit_select as $boxPermit)
                                <option value="{{ $boxPermit->id }}">{{ $boxPermit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-danger-button wire:click="$set('open_edit' , false)" class="ms-4">
                            {{ __('Cancelar') }}
                        </x-danger-button>
                        <x-button wire:click="update" type="submit" class="ms-4">
                            {{ ('Actualizar') }}
                        </x-button>
                    </x-slot>
                </form>
            </x-dialog-modal>
        </div>
    </div>
</div>