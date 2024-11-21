<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraficasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.graficas.index');
    }
    public function obtenerDatos()
    {
        // Ejemplo: Datos estáticos para pruebas
        $datos = [
            'labels' => ['Enero', 'Febrero', 'Marzo', 'Abril'],
            'datasets' => [
                [
                    'label' => 'Residuos generados (kg)',
                    'data' => [500, 700, 800, 600],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    'borderWidth' => 1,
                ]
            ],
        ];

        return response()->json($datos);
    }
}
