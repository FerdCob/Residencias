<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //relacion uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //relacion uno a muchos polimorfica
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    //relacion polimorfica
    public function commentable()
    {
        return $this->morphTo();
    }
}