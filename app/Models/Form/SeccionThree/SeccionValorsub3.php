<?php

namespace App\Models\Form\SeccionThree;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionValorsub3 extends Model
{
    use HasFactory;
    protected $table = 'sec3valsub';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_valorsubproducto'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps
}
