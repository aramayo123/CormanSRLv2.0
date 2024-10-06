<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rubro extends Model
{
    use HasFactory;
    protected $fillable = [
        'rubro',
    ];
    public function Materiales():HasMany
    {
        return $this->hasMany(Material::class);
    }
}
