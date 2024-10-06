<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Estado::create([
            'numero' => '1',
            'estado' => 'ABIERTO'
        ]);
        Estado::create([
            'numero' => '2',
            'estado' => 'CERRADO'
        ]);
        Estado::create([
            'numero' => '3',
            'estado' => 'PENDIENTE'
        ]);
    }
}
