<?php

namespace App\Policies;

use App\Models\Evidence;
use App\Models\User;

class EvidencePolicy
{
    public function author(User $user, Evidence $evidencia): bool
    {
        // Verificar si el usuario está autorizado a manejar evidencias de su hotel
        return $user->hotel->idHotel === $evidencia->id_hotel;
    }
}
