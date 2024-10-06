<?php

namespace Database\Seeders;

use App\Models\Prioridad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioridadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Prioridad::create([
            'numero' => '1',
            'prioridad' => 'ALTA',
        ]);
        Prioridad::create([
            'numero' => '2',
            'prioridad' => 'MEDIA',
        ]);
        Prioridad::create([
            'numero' => '3',
            'prioridad' => 'BAJA',
        ]);
    }
}
