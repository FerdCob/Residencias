<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonaService
{
    public function prepararDatosPersona(Request $request)
    {
        // Datos que cambian en cada vuelta
        $datos_persona = [
            // Numero de personas en la Percapita

            [
                'id_tpercapita' => $request->habitacion,
                'cantidad' => $request->nho,
            ],
            [

                'id_tpercapita' => $request->huesped,
                'cantidad' => $request->nhn,
            ],
            [

                'id_tpercapita' => $request->personal,
                'cantidad' => $request->np,
            ],

        ];

        // ID del hotel y fecha, que son constantes en cada iteración
        $idHotel = Auth::user()->hotel->idHotel;
        $fecha = $request->fecha;

        // Array para almacenar todos los datos de inserción
        $insert_data = [];

        // Bucle para preparar cada conjunto de datos
        foreach ($datos_persona as $dato) {
            $insert_data[] = [
                'idHotel' => $idHotel,
                'id_tpercapita' => $dato['id_tpercapita'],
                'fecha' => $fecha,
                'cantidad' => $dato['cantidad'],
            ];
        }

        return $insert_data;
    }
}
