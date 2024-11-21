<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValorSec5Service
{
    public function prepararDatosValor(Request $request)
    {
        // Datos que cambian en cada vuelta
        $datos_valor = [
            // Numero de valor en la valor

            [
                'id_peso' => $request->volRep,
                'valorkg' => $request->vol_r1,
            ],
            [
                'id_peso' => $request->pesoNet,
                'valorkg' => $request->peso_net1,
            ],
            [
                'id_peso' => $request->pesoVol,
                'valorkg' => $request->peso_vol1,
            ],


        ];

        // ID del hotel y fecha, que son constantes en cada iteración
        $idHotel = Auth::user()->hotel->idHotel;
        $fecha = $request->fecha;

        // Array para almacenar todos los datos de inserción
        $insert_data = [];

        // Bucle para preparar cada conjunto de datos
        foreach ($datos_valor as $dato) {
            $insert_data[] = [
                'idHotel' => $idHotel,
                'id_peso' => $dato['id_peso'],
                'fecha' => $fecha,
                'valorkg' => $dato['valorkg'],
            ];
        }

        return $insert_data;
    }
}
