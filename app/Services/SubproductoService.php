<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubproductoService
{
    public function prepararDatosSubproductos(Request $request)
    {
        // Datos que cambian en cada vuelta
        $datos_subproductos = [
            // Carton Papel Aluminio Metal
            [
                'id_subproductos' => $request->carton,
                'valorkg' => $request->bs_car,
            ],
            [
                'id_subproductos' => $request->papel,
                'valorkg' => $request->bs_pap,
            ],
            [
                'id_subproductos' => $request->aluminio,
                'valorkg' => $request->bs_alu,
            ],
            [
                'id_subproductos' => $request->metal,
                'valorkg' => $request->bs_met,
            ],
            //PET Plastico-Rigigo Jardineria Alimenticios
            [
                'id_subproductos' => $request->pet,
                'valorkg' => $request->bs_pet,
            ],

            [
                'id_subproductos' => $request->plasticoRig,
                'valorkg' => $request->bs_pla,
            ],
            [
                'id_subproductos' => $request->jardin,
                'valorkg' => $request->bs_jar,
            ],
            [
                'id_subproductos' => $request->alimenticio,
                'valorkg' => $request->bs_ali,
            ],
            //Composteables Sanitarios Otros Manejo-Especial
            [
                'id_subproductos' => $request->composta,
                'valorkg' => $request->bs_com,
            ],
            [
                'id_subproductos' => $request->sanitario,
                'valorkg' => $request->bs_san,
            ],
            [
                'id_subproductos' => $request->novalor,
                'valorkg' => $request->bs_nv,
            ],
            [
                'id_subproductos' => $request->especial,
                'valorkg' => $request->bs_ms,
            ],
            //Peligrosos Vidrio
            [
                'id_subproductos' => $request->peligroso,
                'valorkg' => $request->bs_pel,
            ],
            [
                'id_subproductos' => $request->vidrio,
                'valorkg' => $request->bs_vid,
            ],
        ];

        // ID del hotel y fecha, que son constantes en cada iteración
        $idHotel = Auth::user()->hotel->idHotel;
        $fecha = $request->fecha;

        // Array para almacenar todos los datos de inserción
        $insert_data = [];

        // Bucle para preparar cada conjunto de datos
        foreach ($datos_subproductos as $dato) {
            $insert_data[] = [
                'idHotel' => $idHotel,
                'id_subproductos' => $dato['id_subproductos'],
                'fecha' => $fecha,
                'valorkg' => $dato['valorkg'],
            ];
        }

        return $insert_data;
    }
}
