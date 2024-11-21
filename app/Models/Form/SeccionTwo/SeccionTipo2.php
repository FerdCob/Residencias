<?php

namespace App\Models\Form\SeccionTwo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionTipo2 extends Model
{
    use HasFactory;
    protected $table = 'sec2tipo';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_percapita'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps
}
