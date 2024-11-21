<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;



    protected $table = 'hoteles';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'idHotel'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps
    protected $fillable = ['nombre', 'direccion', 'contacto'];
    //protected $keyType = 'string'; // Asegúrate de que sea 'int'
    // protected $connection = 'mysql';
}
