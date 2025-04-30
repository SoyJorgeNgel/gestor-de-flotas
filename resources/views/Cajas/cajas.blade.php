@extends('layouts.app')
@section('title')
Cajas
@endsection

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">

            @livewire('cajas.show-boxes')

        </div>
    </div>
@endsection