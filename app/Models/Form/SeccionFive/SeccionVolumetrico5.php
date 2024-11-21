<?php

namespace App\Models\Form\SeccionFive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionVolumetrico5 extends Model
{
    use HasFactory;
    protected $table = 'sec5vtria';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_volumetria2'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps
}
