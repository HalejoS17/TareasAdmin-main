<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'completada'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
