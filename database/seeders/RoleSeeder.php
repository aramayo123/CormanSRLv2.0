<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $operario = Role::create(['name' => 'Operario']);
        $facilitie = Role::create(['name' => 'Facilitie']);
        $corman = Role::create(['name' => 'Corman']);

        Permission::create(['name' => 'users.index'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'users.create'])->syncRoles([$corman]);
        Permission::create(['name' => 'users.read'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'users.update'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'users.destroy'])->syncRoles([$corman]);

        
        Permission::create(['name' => 'roles'])->syncRoles([$corman]);

        Permission::create(['name' => 'tareas.index'])->syncRoles([$facilitie, $corman, $operario]);
        Permission::create(['name' => 'tareas.create'])->syncRoles([$facilitie, $corman, $operario]);
        Permission::create(['name' => 'tareas.read'])->syncRoles([$facilitie, $corman, $operario]);
        Permission::create(['name' => 'tareas.update'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'tareas.destroy'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'tareas.notificar'])->syncRoles([$facilitie, $corman]);

        Permission::create(['name' => 'tareas.completar'])->syncRoles([$operario, $corman]);

        Permission::create(['name' => 'profile.index'])->syncRoles([$facilitie, $corman, $operario]);
        Permission::create(['name' => 'profile.create'])->syncRoles([$corman]);
        Permission::create(['name' => 'profile.read'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'profile.update'])->syncRoles([$facilitie, $corman, $operario]);
        Permission::create(['name' => 'profile.destroy'])->syncRoles([$corman]);
        
        Permission::create(['name' => 'clientes.index'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'clientes.create'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'clientes.read'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'clientes.update'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'clientes.destroy'])->syncRoles([$facilitie, $corman]);
        
        Permission::create(['name' => 'sucursales.index'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'sucursales.create'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'sucursales.read'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'sucursales.update'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'sucursales.destroy'])->syncRoles([$facilitie, $corman]);
        
        Permission::create(['name' => 'materiales.index'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'materiales.create'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'materiales.read'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'materiales.update'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'materiales.destroy'])->syncRoles([$facilitie, $corman]);


        Permission::create(['name' => 'rubros.index'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'rubros.create'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'rubros.read'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'rubros.update'])->syncRoles([$facilitie, $corman]);
        Permission::create(['name' => 'rubros.destroy'])->syncRoles([$facilitie, $corman]);

        
        Permission::create(['name' => 'historial'])->syncRoles([$corman]);
    }
}
