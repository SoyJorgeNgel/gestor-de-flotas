<?php

namespace App\Livewire;

use App\Models\Box;
use App\Models\Tractor;
use App\Models\Travels;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        //Contadores de usuarios, tractores, cajas y viajes totales
        $totalUsuarios = User::count();
        $totalTractores = Tractor::count();
        $totalCajas = Box::count();
        $totalViajes = Travels::count();

        //Obtenemos los ultimos seis meses
        $ultimos6Meses = Carbon::now()->subMonths(6);
        //Consulta en laravel para contar los viajes en los ultimos 6 meses 
        $viajesPorMes = DB::table('travels')
            ->select(DB::raw('MONTH(returnDate) as mes'), DB::raw('COUNT(*) as viajes'))
            ->where('returnDate', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 6 MONTH)'))
            ->groupBy(DB::raw('MONTH(returnDate)'))
            ->orderBy(DB::raw('MONTH(returnDate)'))
            ->get();

        $travelsMonth = [];
        foreach ($viajesPorMes as $viaje) {
            // Obtener el nombre del mes usando Carbon
            $nombreMes = Carbon::create()->month($viaje->mes)->monthName;

            $travelsMonth['label'][] = $nombreMes;
            $travelsMonth['data'][] = $viaje->viajes;
        }
        //Pasamos la informacion a JSON
        $travelsMonth = json_encode($travelsMonth);

        //Grafica de gastos
        $totalCostosPorMes = DB::table('travels')
            ->select(DB::raw('MONTH(returnDate) as mes'), DB::raw('SUM(expense) as total_costo'))
            ->where('returnDate', '>=', $ultimos6Meses)
            ->groupBy(DB::raw('MONTH(returnDate)'))
            ->orderBy(DB::raw('MONTH(returnDate)'))
            ->get();
        $expenseData = [];
        foreach ($totalCostosPorMes as $gastos) {
            $nombreMes = Carbon::create()->month($gastos->mes)->monthName;
            $expenseData['label'][] = $nombreMes;
            $expenseData['data'][] = $gastos->total_costo;
        }
        $expenseData = json_encode($expenseData);

        //Grafica de roles    
        $rolesWithCounts = DB::table('roles')
            ->select('roles.id', 'roles.role', DB::raw('COUNT(users.id) as users_count'))
            ->leftJoin('users', 'roles.id', '=', 'users.role_id')
            ->groupBy('roles.id', 'roles.role')
            ->get();
        $rolesData = [];
        foreach ($rolesWithCounts as $roles) {
            $rolesData['label'][] = $roles->role;
            $rolesData['data'][] = $roles->users_count;
        }
        $rolesData = json_encode($rolesData);

        //grafica de kilometraje de los tractores
        $kilometraje = Tractor::all();
        $kiloData = [];
        foreach ($kilometraje as $kilo) {
            $kiloData['label'][] = $kilo->plate;
            $kiloData['data'][] = $kilo->mileage;
        }
        $kiloData = json_encode($kiloData);

        //Grafica de dias,kilometros y cantidad
        $recentTravel = Travels::select('tractors.plate', 'travels.kmTraveled', 'travels.quantity')
            ->selectRaw('DATEDIFF(travels.returnDate, travels.departureDate) AS days_difference')
            ->join('tractors', 'tractors.id', '=', 'travels.tractor_id')
            ->where('travels.returnDate', '<=', now())
            ->orderBy('travels.returnDate', 'desc')
            ->limit(10)
            ->get();

        // Procesar los datos para el gráfico
        $chartData = [];
        $labels = []; // Array para almacenar las placas de los camiones
        foreach ($recentTravel as $travel) {
            $labels[] = $travel->plate; // Añadir la placa del camión como etiqueta
            $chartData[] = [
                'x' => $travel->kmTraveled,
                'y' => $travel->days_difference,
                'r' => $travel->quantity
            ];
        }
        //Contadores
        $data = [
            'users' => $totalUsuarios,
            'tractors' => $totalTractores,
            'boxes' => $totalCajas,
            'travels' => $totalViajes
        ];
        $this->checkUserRole();
        //dd($rolesWithCounts);
        return view('livewire.dashboard', $data)
            ->with('rolesData', $rolesData)
            ->with('travelsMonth', $travelsMonth)
            ->with('expenseData', $expenseData)
            ->with('chartData', $chartData)
            ->with('kiloData', $kiloData)
            ->with('labels', $labels);
    }
    public function checkUserRole()
    {
        if (Auth::user()->role_id == 3) {
            return redirect()->to('/viajes');
        }
    }
}
