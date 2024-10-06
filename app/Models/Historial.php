<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Historial extends Model
{
    use HasFactory;
    protected $table = "historiales";
    protected $fillable = [
        'data',
        'user_id',
        'accion',
        'fecha',
        'hora',
    ];

    public function Autor(): HasOne
    {
        // llave foreign es el nombre del campo en la tabla actual
        // llave local es el nombre del campo en la tabla que queremos buscar
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
