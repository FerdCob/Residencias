<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form\SeccionFive\SeccionVolumetrico5;
use App\Models\Form\SeccionFour\SeccionVolumetrico4;
use App\Models\Form\SeccionOne\SeccionGeneracion1;
use App\Models\Form\SeccionThree\SeccionValorsub3;
use App\Models\Form\SeccionTwo\SeccionTotal2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GraficasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // Procesar secciones y calcular promedios
        $procesarSeccion = function ($idSeccion) use ($fechaInicio, $fechaFin) {
            $datos = SeccionGeneracion1::where('idHotel', Auth::user()->hotel->idHotel)
                ->where('id_nomseccion', $idSeccion)
                ->with('sec1nom');

            if ($fechaInicio && $fechaFin) {
                $datos->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            }

            $agrupados = $datos->get()->groupBy('sec1nom.nom_residuo')->map(function ($grupo) {
                return $grupo->avg('valorkg'); // Cambia suma por promedio
            });

            return [
                'nombres' => $agrupados->keys(),
                'valores' => $agrupados->values(),
            ];
        };

        $restaurantes = $procesarSeccion(4);
        $areasComunes = $procesarSeccion(5);
        $habitaciones = $procesarSeccion(6);

        // Consulta de promedios de valorkg y nombre del subproducto
        $subproductos = SeccionValorsub3::where('idHotel', Auth::user()->hotel->idHotel)
            ->with('sec3subpro:id_subproducto,tipo')
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            })
            ->get(['valorkg', 'id_subproductos']);

        $graficaSubproductos = $subproductos->groupBy('sec3subpro.tipo')->map(function ($grupo) {
            return $grupo->avg('valorkg'); // Cambia suma por promedio
        });

        $nombresSubproductos = $graficaSubproductos->keys();
        $valoresSubproductos = $graficaSubproductos->values();

        // Consulta de promedio de valorkg Percapita
        $percapita = SeccionTotal2::where('idHotel', Auth::user()->hotel->idHotel);
        if ($fechaInicio && $fechaFin) {
            $percapita->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $datos = $percapita->get(['percapita1', 'percapita2']);

        $totalPercapita1 = $datos->avg('percapita1'); // Promedio de percapita1
        $totalPercapita2 = $datos->avg('percapita2'); // Promedio de percapita2

        $labels = ['Generación por Persona', 'Generación por Habitaciones'];

        // Consulta de promedio de valorkg Volumetría
        $volumetria4 = SeccionVolumetrico4::where('idHotel', Auth::user()->hotel->idHotel)
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            })
            ->get('valorkg');

        $volumetria5 = SeccionVolumetrico5::where('idHotel', Auth::user()->hotel->idHotel)
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            })
            ->get('valorkg');

        $totalvtr4 = $volumetria4->avg('valorkg'); // Promedio de volumetría 4
        $totalvtr5 = $volumetria5->avg('valorkg'); // Promedio de volumetría 5

        $labelsvtria = ['Generación Valorizable', 'Generación No Valorizable'];

        // Retornar los datos a la vista
        return view('admin.graficas.index', [
            'restaurantes' => $restaurantes,
            'areasComunes' => $areasComunes,
            'habitaciones' => $habitaciones,
            'nombresSubproductos' => $nombresSubproductos,
            'valoresSubproductos' => $valoresSubproductos,
            'labels' => $labels,
            'datosPercapita1' => $totalPercapita1,
            'datosPercapita2' => $totalPercapita2,
            'labelstria' => $labelsvtria,
            'volumetria4' => $totalvtr4,
            'volumetria5' => $totalvtr5,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ]);
    }
}