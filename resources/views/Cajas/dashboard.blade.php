@extends('layouts.app')
@section('title')
Cajas y cargas
@endsection

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="mx-auto sm:px-6 lg:px-8">
        <div>
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h5 class="inline-block">Cajas y cargas</h5>
                </div>

                <div class="card-body flex flex-row">
                    @livewire('cajas.show-types', ['tablaId' => 'box_types'])
                    @livewire('cajas.show-sizes', ['tablaId' => 'box_sizes'])
                </div>

                <div class="card-body flex flex-row">
                    @livewire('cajas.show-cargo', ['tablaId' => 'box_cargo'])
                    @livewire('cajas.show-permit', ['tablaId' => 'box_permit'])
                </div>

            </div>
        </div>
    </div>
</div>
@endsection