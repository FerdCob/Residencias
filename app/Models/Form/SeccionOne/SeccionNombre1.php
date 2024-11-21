<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionNombre1 extends Model
{
    use HasFactory;
    protected $table = 'sec1t_residuo';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_residuo'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps
}
