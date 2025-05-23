<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    //relacion muchos a muchos polimorfica
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
