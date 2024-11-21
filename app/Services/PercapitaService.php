<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PercapitaService
{
    public function prepararDatosPercapita(Request $request)
    {
        // Datos que cambian en cada vuelta
        $datos_percapita = [
            // Numero de percapitas en la Percapita

            [
                'percapita1' => $request->totalp1,
                'percapita2' => $request->totalh1,
            ],


        ];

        // ID del hotel y fecha, que son constantes en cada iteración
        $idHotel = Auth::user()->hotel->idHotel;
        $fecha = $request->fecha;

        // Array para almacenar todos los datos de inserción
        $insert_data = [];

        // Bucle para preparar cada conjunto de datos
        foreach ($datos_percapita as $dato) {
            $insert_data[] = [
                'idHotel' => $idHotel,
                'fecha' => $fecha,
                'percapita1' => $dato['percapita1'],
                'percapita2' => $dato['percapita2'],
            ];
        }

        return $insert_data;
    }
}
