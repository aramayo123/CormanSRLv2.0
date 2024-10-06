<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TareaAsignada extends Model
{
    use HasFactory;
    protected $table = "tareas_asignadas";
    protected $fillable = [
        'tarea_id',
        'user_id',
    ];
    public function Tarea(): HasOne
    {
        return $this->hasOne(Tarea::class, 'id', 'tarea_id');
    }
    public function User(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
