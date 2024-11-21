<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GentotalService
{
    public function prepararDatosResiduos(Request $request)
    {
        // Datos que cambian en cada vuelta
        $datos_residuos = [
            // Seccion 1 Restaurante
            [
                'id_nomseccion' => $request->seccion1,
                'id_tiporesiduo' => $request->residuo1,
                'valorkg' => $request->rali_kg,
            ],
            [
                'id_nomseccion' => $request->seccion1,
                'id_tiporesiduo' => $request->residuo2,
                'valorkg' => $request->rcom_kg,
            ],
            [
                'id_nomseccion' => $request->seccion1,
                'id_tiporesiduo' => $request->residuo3,
                'valorkg' => $request->rino_kg,
            ],
            [
                'id_nomseccion' => $request->seccion1,
                'id_tiporesiduo' => $request->residuo03,
                'valorkg' => $request->rnva_kg,
            ],
            // Seccion 3 Habitaciones
            [
                'id_nomseccion' => $request->seccion3,
                'id_tiporesiduo' => $request->residuo8,
                'valorkg' => $request->hino_kg,
            ],
            [
                'id_nomseccion' => $request->seccion3,
                'id_tiporesiduo' => $request->residuo9,
                'valorkg' => $request->hotr_kg,
            ],
            // Seccion 2 Areas comunes
            [
                'id_nomseccion' => $request->seccion2,
                'id_tiporesiduo' => $request->residuo4,
                'valorkg' => $request->asan_kg,
            ],
            [
                'id_nomseccion' => $request->seccion2,
                'id_tiporesiduo' => $request->residuo5,
                'valorkg' => $request->ajar_kg,
            ],
            [
                'id_nomseccion' => $request->seccion2,
                'id_tiporesiduo' => $request->residuo6,
                'valorkg' => $request->aino_kg,
            ],
        ];

        // ID del hotel y fecha, que son constantes en cada iteración
        $idHotel = Auth::user()->hotel->idHotel;
        $fecha = $request->fecha;

        // Array para almacenar todos los datos de inserción
        $insert_data = [];

        // Bucle para preparar cada conjunto de datos
        foreach ($datos_residuos as $dato) {
            $insert_data[] = [
                'idHotel' => $idHotel,
                'id_nomseccion' => $dato['id_nomseccion'],
                'id_tiporesiduo' => $dato['id_tiporesiduo'],
                'fecha' => $fecha,
                'valorkg' => $dato['valorkg'],
            ];
        }

        return $insert_data;
    }
}