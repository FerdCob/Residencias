<?php

namespace App\Models\Form\SeccionTwo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionCantidad2 extends Model
{
    use HasFactory;
    protected $table = 'sec2per';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_seccion2'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps
}
