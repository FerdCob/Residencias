<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionResiduo1 extends Model
{
    use HasFactory;

    protected $table = 'sec1_nom';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_nomseccion'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps
}
