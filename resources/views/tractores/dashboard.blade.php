@extends('layouts.app')
@section('title')
Marcas y modelos
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
                    <h5 class="inline-block">Marcas y modelos</h5>
                </div>

                <div class="card-body flex flex-row">
                    @livewire('tractores.show-brands', ['tablaId' => 'truck_brands'])
                    @livewire('tractores.show-models', ['tablaId' => 'truck_models'])
                </div>

            </div>
        </div>
    </div>
</div>
@endsection