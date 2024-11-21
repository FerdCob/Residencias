<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NovalorService
{
    public function prepararDatosNovalor(Request $request)
    {
        // Datos que cambian en cada vuelta
        $datos_novalor = [
            // Numero de novalors en la novalor

            [
                'id_peso' => $request->volRep,
                'valorkg' => $request->vol_r2,
            ],
            [
                'id_peso' => $request->pesoNet,
                'valorkg' => $request->peso_net2,
            ],
            [
                'id_peso' => $request->pesoVol,
                'valorkg' => $request->peso_vol2,
            ],


        ];

        // ID del hotel y fecha, que son constantes en cada iteración
        $idHotel = Auth::user()->hotel->idHotel;
        $fecha = $request->fecha;

        // Array para almacenar todos los datos de inserción
        $insert_data = [];

        // Bucle para preparar cada conjunto de datos
        foreach ($datos_novalor as $dato) {
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
