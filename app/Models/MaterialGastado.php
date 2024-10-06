<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialGastado extends Model
{
    use HasFactory;
    protected $table = "materiales_gastados";
    protected $fillable = [
        'material_id',
        'tarea_id',
        'cantidad',
        'precio',
    ];
    public function Material(){
        return $this->hasOne(Material::class, 'id', 'material_id');
    }
    public function Tarea(){
        return $this->hasOne(Tarea::class, 'id', 'tarea_id');
    }
}
