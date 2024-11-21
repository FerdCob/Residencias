<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Evidence extends Model
{
    use HasFactory;

    protected $table = 'evidenciasimg';  // Nombre de tu tabla en la base de datos
    // protected $primaryKey = 'id'; // Nombre de la clave primaria
    // public $timestamps = false; // Desactiva el uso de timestamps
    protected $fillable = ['id_hotel', 'title', 'slug_image', 'fecha', 'image_path', 'descripcion'];
    //protected $keyType = 'string'; // Asegúrate de que sea 'int'
    // protected $connection = 'mysql';
    protected function title(): Attribute
    {
        return new Attribute(
            //set es un mutador que se encarga de modificar el valor antes de guardarlo en la base de datos
            //esta linea se encarga de capturar y transformar el valor en minusculas
            set: fn($value) => strtolower($value),
            //get es un accesor que se encarga de modificar el valor antes de mostrarlo
            //esta linea se encarga de capturar y transformar la primera letra en mayuscula
            get: fn($value) => ucfirst($value),
        );
    }
    protected function image(): Attribute
    {
        return new Attribute(
            // get: fn() => $this->image_path ?? 'data:image/png;base64,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',
            get: function () {
                if ($this->image_path) {
                    //verificar si la url comienza con https://
                    if (substr($this->image_path, 0, 8) === 'https://') {
                        return $this->image_path;
                    } else {
                        return Storage::url($this->image_path);
                    }
                } else {
                    return 'https://via.placeholder.com/300x200?text=No+Image';
                }
            }
        );
    }
}
