<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Cajas\Box_permit;
use App\Models\Cajas\Box_size;
use App\Models\Cajas\Box_type;
use App\Models\Role;
use App\Models\Tractor;
use App\Models\Tractores\Truck_model;
use App\Models\Travels;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportGeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $boxTypes = Box_type::all();
        $boxSizes = Box_size::all();
        $boxPermits = Box_permit::all();
        $models = Truck_model::all();
        return view('Reportes.reportes', compact('roles', 'boxTypes', 'boxSizes', 'boxPermits', 'models'));
    }
    public function generatePDF(Request $request)
    {
        $roleId = $request->input('role');

        if ($roleId === 'all') {
            $users = User::all();
        } else {
            $users = User::where('role_id', $roleId)->get();
        }

        $pdf = Pdf::loadView('reportes.pdf', ['users' => $users]);

        return $pdf->stream('Usuarios.pdf');
    }

    public function boxGeneratePDF(Request $request)
    {
        $boxesQuery = Box::query();

        if ($request->filled('type')) {
            $boxesQuery->where('box_type_id', $request->type);
        }

        if ($request->filled('size')) {
            $boxesQuery->where('box_size_id', $request->size);
        }

        if ($request->filled('permit')) {
            $boxesQuery->where('box_permit_id', $request->permit);
        }

        $boxes = $boxesQuery->get();
        

        $pdf = Pdf::loadView('reportes.boxes_pdf', ['boxes' => $boxes]);

        return $pdf->stream('Cajas.pdf');
    }
    public function travelGeneratePDF(Request $request)
{
    $travelsQuery = Travels::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $travelsQuery->whereBetween('returnDate', [$request->start_date, $request->end_date]);
    }

    $travels = $travelsQuery->get();

    $pdf = Pdf::loadView('reportes.travels_pdf', ['travels' => $travels])->setPaper('a3', 'landscape');

    return $pdf->stream('Viajes.pdf');
}

    public function truckerGeneratePDF(Request $request)
    {
        $modelId = $request->input('model');

        if ($modelId === 'all') {
            $tractor = Tractor::all();
        } else {
            $tractor = Tractor::where('truck_model_id', $modelId)->get();
        }

        $pdf = Pdf::loadView('reportes.trucker_pdf', ['tractor' => $tractor]);

        return $pdf->stream('Tractores.pdf');
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
