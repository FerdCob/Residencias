<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ValorizablesService
{

    public function prepararDatosValorizable(Request $request)
    {
        // Datos que cambian en cada vuelta
        $datos_valorizable = [
            // Numero de valorizables en la valorizable

            [
                'semana' => $request->semana,
                'dia' => $request->dia,
                'valorkg' => $request->total_valor,
            ],


        ];

        // ID del hotel y fecha, que son constantes en cada iteración
        $idHotel = Auth::user()->hotel->idHotel;
        $fecha = $request->fecha;

        // Array para almacenar todos los datos de inserción
        $insert_data = [];

        // Bucle para preparar cada conjunto de datos
        foreach ($datos_valorizable as $dato) {
            $insert_data[] = [
                'idHotel' => $idHotel,
                'fecha' => $fecha,
                'semana' => $dato['semana'],
                'dia' => $dato['dia'],
                'valorkg' => $dato['valorkg'],
            ];
        }

        return $insert_data;
    }
}
