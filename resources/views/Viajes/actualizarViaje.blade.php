@extends('layouts.app')
@section('title')
Editar viaje
@endsection

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="mx-auto sm:px-6 lg:px-8">
        @livewire('viajes.update-travel')
    </div>
</div>
@endsection