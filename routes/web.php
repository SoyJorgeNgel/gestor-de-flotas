<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportTravelController;
use App\Http\Controllers\ReportGeneratorController;


Route::get('/', function () {
    return view('auth.login');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('reportes', [ReportGeneratorController::class, 'index'])->name('reportes');
    Route::post('reportes/pdf', [ReportGeneratorController::class, 'generatePDF'])->name('generate-pdf');
    Route::get('reportes/cajas', [ReportGeneratorController::class, 'boxGeneratePDF'])->name('box-generate-pdf');
    Route::get('reportes/viajes', [ReportGeneratorController::class, 'travelGeneratePDF'])->name('travel-generate-pdf');
    Route::post('reportes/tractores', [ReportGeneratorController::class, 'truckerGeneratePDF'])->name('trucker-generate-pdf');
    Route::post('viajes/reporte', [ReportTravelController::class, 'travelGeneratePDF'])->name('viajes.reporte');
    Route::get('/dashboard', function () {
        return view('home');
    })->name('home');
    Route::get('/', function () {
        return view('home');
    })->name('home');
})->group(function () {
    Route::get('/usuarios', function () {
        return view('dashboard');
    })->name('dashboard');
})->group(function () {
    Route::get('/cajas/dashboard', function () {
        return view('Cajas.dashboard');
    })->name('Caja');
})->group(function () {
    Route::get('/tractores/dashboard', function () {
        return view('Tractores.dashboard');
    })->name('Tractores');
})->group(function () {
    Route::get('/cajas', function () {
        return view('Cajas.cajas');
    })->name('Cajas');
})->group(function () {
    Route::get('/tractores', function () {
        return view('tractores.tractores');
    })->name('tractores');
})->group(function () {
    Route::get('/viajes/destinos', function () {
        return view('Viajes.destinos');
    })->name('destinos');
})->group(function () {
    Route::get('/viajes/salidas', function () {
        return view('Viajes.salidas');
    })->name('salidas');
})->group(function () {
    Route::get('/viajes', function () {
        return view('Viajes.viajes');
    })->name('viajes');
    Route::get('/viajes/edit', function () {
        return view('Viajes.actualizarViaje');
    })->name('actualizarViaje');  // Cambié el nombre de la ruta a actualizarViaje
});
