<?php

namespace App\Http\Controllers;

use App\Models\RouteLog;
use App\Models\Travels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportTravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }
    public function travelGeneratePDF(Request $request)
    {
        $viajeId = $request->input('viaje_id');
        $viaje = Travels::findOrFail($viajeId);

        $detinos = RouteLog::where('travel_id' , $viajeId)->get();

        $pdf = Pdf::loadView('Reportes.travel', ['viaje' => $viaje],['destinos' => $detinos]);

        return $pdf->stream('Reporte_viaje.pdf');

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
