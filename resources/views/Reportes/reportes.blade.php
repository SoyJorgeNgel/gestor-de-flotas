@extends('layouts.app')
@section('title')
Reportes
@endsection

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="p-6">
    <div class="card-header">
        <div class="flex justify-between items-center">
            <h5 class="inline-block">Reportes</h5>
        </div>
        <div class="card-body">
            <div class="space-x-4 pb-5">
                <div class="max-w-full">
                    <div class="bg-gray-100 rounded-lg shadow-md">
                        <div class="border-b">
                            <button class="w-full text-left p-4 focus:outline-none" onclick="toggleAccordion('accordion-item-1')">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-medium">Reporte de usuarios</span>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </button>
                            <div id="accordion-item-1" class="p-4 hidden bg-white">
                                <form method="POST" action="{{ route('generate-pdf') }}" target="_blank" class="flex items-center space-x-4">
                                    @csrf
                                    <div class="flex flex-col">
                                        <x-label for="role" value="Selecciona un rol" class="mb-1" />
                                        <select name="role" id="role" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="all">Todos</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-danger-button wire:click="$set('open', false)" type="submit" class="flex px-4 py-2 mt-4">
                                        <i class='bx bxs-file-pdf'></i> <span class="ml-2">Generar PDF</span>
                                    </x-danger-button>
                                </form>

                            </div>
                        </div>

                        <div class="border-b">
                            <button class="w-full text-left p-4 focus:outline-none" onclick="toggleAccordion('accordion-item-2')">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-medium">Reporte de cajas</span>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </button>
                            <div id="accordion-item-2" class="p-4 hidden">
                                <form action="{{ route('box-generate-pdf') }}" method="GET" target="_blank" class="flex items-center space-x-4">
                                    <div class="flex flex-col">
                                        <x-label for="size" class="mb-1" value="Tipo de caja:"></x-label>
                                        <select name="type" id="type" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">Todos</option>
                                            @foreach($boxTypes as $boxType)
                                            <option value="{{ $boxType->id }}">{{ $boxType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col">
                                        <x-label for="size" class="mb-1" value="Tamaño:"></x-label>
                                        <select name="size" id="size" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">TODOS</option>
                                            @foreach($boxSizes as $boxSize)
                                            <option value="{{ $boxSize->id }}">{{ $boxSize->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col">
                                        <x-label for="size" class="mb-1" value="Permiso:"></x-label>
                                        <select name="permit" id="permit" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">TODOS</option>
                                            @foreach($boxPermits as $boxPermit)
                                            <option value="{{ $boxPermit->id }}">{{ $boxPermit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-danger-button wire:click="$set('open', false)" type="submit" class="flex items-center px-4 py-2 mt-4">
                                        <i class='bx bxs-file-pdf'></i> <span class="ml-2">Generar PDF</span>
                                    </x-danger-button>
                                </form>

                            </div>
                        </div>

                        <div>
                            <button class="w-full text-left p-4 focus:outline-none" onclick="toggleAccordion('accordion-item-3')">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-medium">Reporte de tractores</span>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </button>
                            <div id="accordion-item-3" class="p-4 hidden">
                                <form method="POST" action="{{ route('trucker-generate-pdf') }}" target="_blank" class="flex items-center space-x-4">
                                    @csrf
                                    <div class="flex flex-col">
                                        <x-label for="model" value="Selecciona un modelo" class="mb-1" />
                                        <select name="model" id="model" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="all">TODOS</option>
                                            @foreach($models as $model)
                                            <option value="{{ $model->id }}">{{$model->truck_brand->name ." ". $model->model . " " . $model->year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-danger-button wire:click="$set('open', false)" type="submit" class="flex items-center px-4 py-2 mt-4">
                                        <i class='bx bxs-file-pdf'></i> <span class="ml-2">Generar PDF</span>
                                    </x-danger-button>
                                </form>

                            </div>
                        </div>
                        <div class="border-b">
                            <button class="w-full text-left p-4 focus:outline-none" onclick="toggleAccordion('accordion-item-4')">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-medium">Reporte de viajes</span>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </button>
                            <div id="accordion-item-4" class="p-4 hidden">
                                <form action="{{ route('travel-generate-pdf') }}" method="GET" target="_blank" class="flex flex-wrap items-center gap-4">
                                    @csrf
                                    <div class="flex flex-col">
                                        <x-label for="start_date" class="mb-1" value="Fecha de inicio:" />
                                        <input type="date" name="start_date" id="start_date" class="border border-gray-300 rounded-md px-2 py-1 focus:outline-none focus:border-blue-500">
                                    </div>

                                    <div class="flex flex-col">
                                        <x-label for="end_date" class="mb-1" value="Fecha de fin:" />
                                        <input type="date" name="end_date" id="end_date" class="border border-gray-300 rounded-md px-2 py-1 focus:outline-none focus:border-blue-500">
                                    </div>

                                    <x-danger-button wire:click="$set('open', false)" type="submit" class="flex items-center px-4 py-2 mt-4">
                                        <i class='bx bxs-file-pdf'></i> <span class="ml-2">Generar PDF</span>
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleAccordion(id) {
            const element = document.getElementById(id);
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }
    </script>
    @endsection