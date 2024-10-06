<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'CORMAN',
            'username' => 'corman',
            'email' => 'corman@example.com',
            'password' => Hash::make('corman'),
        ])->assignRole('Corman');

        User::create([
            'name' => 'MOVIL24',
            'username' => 'movil24',
            'email' => 'movil24@example.com',
            'password' => Hash::make('movil24'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Aramayo Diego',
            'username' => 'diego',
            'email' => 'diego@example.com',
            'password' => Hash::make('diego2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Sajama Alejandro',
            'username' => 'alejandro',
            'email' => 'alejandro@example.com',
            'password' => Hash::make('alejandro2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Aramayo Luis',
            'username' => 'luis',
            'email' => 'luis@example.com',
            'password' => Hash::make('luis2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Torres Jimena',
            'username' => 'jimena',
            'email' => 'jimena@example.com',
            'password' => Hash::make('jimena2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Torres Horacio',
            'username' => 'horacio',
            'email' => 'horacio@example.com',
            'password' => Hash::make('horacio2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Luna Anibal',
            'username' => 'anibal',
            'email' => 'anibal@example.com',
            'password' => Hash::make('anibal2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Angel Nava',
            'username' => 'angel',
            'email' => 'angel@example.com',
            'password' => Hash::make('angel2024'),
        ])->assignRole('Facilitie');
    }
}
