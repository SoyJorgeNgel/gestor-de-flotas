<div>
    <x-button class="text-white text-sm" wire:click="$set('open' , true)"><i class='bx bxs-box pr-1' ></i>Nueva caja</x-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">Crear caja</x-slot>
        <x-slot name="content">
            <x-validation-errors class="mb-4" />
            <div>
                <x-label for="boxTypeSelectCreate" value="Tipo de caja" />
                <select wire:model.live="box_type_id" id="boxTypeSelectCreate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Selecciona el tipo de caja</option>
                    @foreach ($boxType_select as $boxType)
                    <option value="{{ $boxType->id }}">{{ $boxType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-label for="plate_reg" value="Placa" />
                <x-input class="block mt-1 w-full" wire:model.live="plate" type="text" id="plate_reg" name="plate_reg" :value="old('plate_reg')" oninput="this.value = this.value.toUpperCase()" required autofocus autocomplete="plate_reg" />
            </div>
            <div>
                <x-label for="boxSizeSelectCreate" value="Tamaño" />
                <select wire:model.live="box_size_id" id="boxSizeSelectCreate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Selecciona el tamaño</option>
                    @foreach ($boxSize_select as $boxSize)
                    <option value="{{ $boxSize->id }}">{{ $boxSize->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-label for="boxPermitSelectCreate" value="Permiso" />
                <select wire:model.live="box_permit_id" id="boxPermitSelectCreate" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Selecciona el permiso</option>
                    @foreach ($boxPermit_select as $boxPermit)
                    <option value="{{ $boxPermit->id }}">{{ $boxPermit->name }}</option>
                    @endforeach
                </select>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$set('open' , false)" class="ms-4">
                {{ __('Cancelar') }}
            </x-danger-button>
            <x-button wire:click="register" class="ms-4">
                {{ ('Registrar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>