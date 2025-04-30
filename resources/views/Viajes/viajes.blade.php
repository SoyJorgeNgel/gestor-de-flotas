@extends('layouts.app')
@section('title')
Viajes
@endsection

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="mx-auto sm:px-6 lg:px-8">

        @livewire('viajes.show-travel')

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/postal.js') }}"></script>
@endsection