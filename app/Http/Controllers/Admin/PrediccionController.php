<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form\SeccionOne\SeccionGeneracion1;
use App\Models\Form\SeccionFour\SeccionVolumetrico4;
use App\Models\Form\SeccionFive\SeccionVolumetrico5;
use App\Models\Form\SeccionThree\SeccionValorsub3;
use App\Models\Form\SeccionTwo\SeccionTotal2;
use Illuminate\Support\Facades\Auth;

class PrediccionController extends Controller
{
    public function index(Request $request)
    {
        $procesarSeccion = function ($idSeccion) {
            $datos = SeccionGeneracion1::where('idHotel', Auth::user()->hotel->idHotel)
                ->where('id_nomseccion', $idSeccion)
                ->orderBy('fecha', 'ASC')
                ->get();

            if ($datos->isEmpty()) {
                return [
                    'promedios_semanales' => [],
                    'fecha_inicio' => null,
                    'fecha_fin' => null,
                ];
            }

            $fechaInicio = $datos->first()->fecha;
            $fechaFin = $datos->last()->fecha;

            $semanas = $datos->groupBy(function ($item) use ($fechaInicio) {
                $fechaBase = strtotime($fechaInicio);
                $fechaActual = strtotime($item->fecha);
                $diferenciaDias = ($fechaActual - $fechaBase) / (60 * 60 * 24);
                return floor($diferenciaDias / 7);
            });

            $semanaInicio = 0;
            $semanaFin = floor((strtotime($fechaFin) - strtotime($fechaInicio)) / (60 * 60 * 24 * 7));

            $promediosSemanales = collect();
            for ($i = $semanaInicio; $i <= $semanaFin; $i++) {
                $promediosSemanales[$i] = $semanas->has($i) ? $semanas[$i]->avg('valorkg') : 0;
            }

            return [
                'promedios_semanales' => $promediosSemanales,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
            ];
        };

        $procesarGenerales = function ($model, $campo) {
            $datos = $model::where('idHotel', Auth::user()->hotel->idHotel)
                ->orderBy('fecha', 'ASC')
                ->get();

            if ($datos->isEmpty()) {
                return [
                    'promedios_semanales' => [],
                    'fecha_inicio' => null,
                    'fecha_fin' => null,
                ];
            }

            $fechaInicio = $datos->first()->fecha;
            $fechaFin = $datos->last()->fecha;

            $semanas = $datos->groupBy(function ($item) use ($fechaInicio) {
                $fechaBase = strtotime($fechaInicio);
                $fechaActual = strtotime($item->fecha);
                $diferenciaDias = ($fechaActual - $fechaBase) / (60 * 60 * 24);
                return floor($diferenciaDias / 7);
            });

            $semanaInicio = 0;
            $semanaFin = floor((strtotime($fechaFin) - strtotime($fechaInicio)) / (60 * 60 * 24 * 7));

            $promediosSemanales = collect();
            for ($i = $semanaInicio; $i <= $semanaFin; $i++) {
                $promediosSemanales[$i] = $semanas->has($i) ? $semanas[$i]->avg($campo) : 0;
            }

            return [
                'promedios_semanales' => $promediosSemanales,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
            ];
        };

        $procesarSubproductos = function () {
            $subproductos = SeccionValorsub3::where('idHotel', Auth::user()->hotel->idHotel)
                ->with('sec3subpro:id_subproducto,tipo')
                ->orderBy('fecha', 'ASC')
                ->get(['valorkg', 'fecha', 'id_subproductos']);

            if ($subproductos->isEmpty()) {
                return [];
            }

            $fechaInicio = $subproductos->first()->fecha;
            $fechaFin = $subproductos->last()->fecha;

            $resultados = [];
            $subproductosAgrupados = $subproductos->groupBy('id_subproductos');

            foreach ($subproductosAgrupados as $idSubproducto => $datos) {
                $semanas = $datos->groupBy(function ($item) use ($fechaInicio) {
                    $fechaBase = strtotime($fechaInicio);
                    $fechaActual = strtotime($item->fecha);
                    $diferenciaDias = ($fechaActual - $fechaBase) / (60 * 60 * 24);
                    return floor($diferenciaDias / 7);
                });

                $semanaInicio = 0;
                $semanaFin = floor((strtotime($fechaFin) - strtotime($fechaInicio)) / (60 * 60 * 24 * 7));

                $promediosSemanales = collect();
                for ($i = $semanaInicio; $i <= $semanaFin; $i++) {
                    $promediosSemanales[$i] = $semanas->has($i) ? $semanas[$i]->avg('valorkg') : 0;
                }

                $resultados[$idSubproducto] = [
                    'promedios_semanales' => $promediosSemanales,
                    'fecha_inicio' => $fechaInicio,
                    'fecha_fin' => $fechaFin,
                ];
            }

            return $resultados;
        };

        // Procesar las secciones requeridas
        $restaurantes = $procesarSeccion(4);
        $areasComunes = $procesarSeccion(5);
        $habitaciones = $procesarSeccion(6);

        // Procesar datos de Volumetría
        $volumetria4 = $procesarGenerales(SeccionVolumetrico4::class, 'valorkg');
        $volumetria5 = $procesarGenerales(SeccionVolumetrico5::class, 'valorkg');

        // Procesar datos de Per Cápita
        $percapita1 = $procesarGenerales(SeccionTotal2::class, 'percapita1');
        $percapita2 = $procesarGenerales(SeccionTotal2::class, 'percapita2');

        // Procesar subproductos
        $subproductos = $procesarSubproductos();

        // Retornar JSON si la solicitud es AJAX
        if ($request->ajax()) {
            return response()->json([
                'restaurantes' => $restaurantes,
                'areasComunes' => $areasComunes,
                'habitaciones' => $habitaciones,
                'volumetria4' => $volumetria4,
                'volumetria5' => $volumetria5,
                'percapita1' => $percapita1,
                'percapita2' => $percapita2,
                'subproductos' => $subproductos,
            ]);
        }


        // Retornar la vista con los datos procesados
        return view('admin.predicciones.index', [
            'restaurantes' => $restaurantes,
            'areasComunes' => $areasComunes,
            'habitaciones' => $habitaciones,
            'volumetria4' => $volumetria4,
            'volumetria5' => $volumetria5,
            'percapita1' => $percapita1,
            'percapita2' => $percapita2,
            'subproductos' => $subproductos,
        ]);
    }
}