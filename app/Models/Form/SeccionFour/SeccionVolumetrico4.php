<?php

namespace App\Models\Form\SeccionFour;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionVolumetrico4 extends Model
{
    use HasFactory;
    protected $table = 'sec4vtria';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_volumetria'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps
}
