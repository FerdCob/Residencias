<?php

namespace App\Observers;

use App\Models\Evidence;
use Illuminate\Support\Facades\Auth;

class EvidenceObserver
{
    public function creating(Evidence $evidence)
    {
        // Obtener el id del hotel asignado al usuario autenticado
        $hotelId = Auth::user()->hotel->idHotel; // Asegúrate de que el usuario está autenticado y tiene un hotel

        // Asignar el id_hotel a la evidencia
        $evidence->id_hotel = $hotelId;
    }
}
