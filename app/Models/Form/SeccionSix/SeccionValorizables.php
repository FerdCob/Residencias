<?php

namespace App\Models\Form\SeccionSix;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionValorizables extends Model
{
    use HasFactory;

    protected $table = 'valorizables';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_valorizable'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps

}
