<?php

namespace App\Models\Form\SeccionOne;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SeccionGeneracion1 extends Model
{
    use HasFactory;
    protected $filable = [];

    protected $table = 'sec1gtotal';  // Nombre de tu tabla en la base de datos
    protected $primaryKey = 'id_secTotal'; // Nombre de la clave primaria
    public $timestamps = false; // Desactiva el uso de timestamps

    public function sec1nom()
    {
        return $this->belongsTo(SeccionNombre1::class, 'id_tiporesiduo', 'id_residuo');
    }
}
