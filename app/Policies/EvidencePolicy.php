<?php

namespace App\Policies;

use App\Models\Evidence;
use App\Models\User;


class EvidencePolicy
{
    public function authorEvidence(User $user, Evidence $evidencia): bool
    {
        // Verificar si el usuario está autorizado a manejar evidencias de su hotel
        return (int)$user->hotel->idHotel === (int)$evidencia->id_hotel;
    }
}
