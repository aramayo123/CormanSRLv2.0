<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Material extends Model
{
    protected $table = "materiales";
    use HasFactory;
    protected $fillable = [
        'rubro_id',
        'descripcion',
        'unidad',
    ];
    public function Rubro(): HasOne
    {
        return $this->hasOne(Rubro::class, 'id', 'rubro_id');
    }
}