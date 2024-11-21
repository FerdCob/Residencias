<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Subproducto extends Model
{
    use HasFactory;

    protected $table = 'subproductos';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_subproducto'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps
    protected $fillable = ['tipo'];
}
