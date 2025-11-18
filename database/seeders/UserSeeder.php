<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        $sa = User::factory()->create([
            'name' => 'sa',
            'user' => 'sa',
            'authen' => 1,
            'email' => 'sa@gmail.com',
            'password' => bcrypt('54rtr3007'),
        ]);

        $admin = User::factory()->create([
            'name' => 'admin',
            'user' => 'admin',
            'authen' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        
        $roleSA = Role::firstOrCreate(['name' => 'sa']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleCOM = Role::firstOrCreate(['name' => 'COM']);

        // Permisos Energía
        $permissionEnergiaIndex = Permission::firstOrCreate(['name' => 'energia.index']);
        $permissionEnergiaEditar = Permission::firstOrCreate(['name' => 'energia.editar']);
        $permissionEnergiaUpdate = Permission::firstOrCreate(['name' => 'energia.update']);

        // Permisos Usuarios
        $permissionUsuariosIndex = Permission::firstOrCreate(['name' => 'usuarios.index']);
        $permissionUsuariosEditar = Permission::firstOrCreate(['name' => 'usuarios.editar']);
        $permissionUsuariosUpdate = Permission::firstOrCreate(['name' => 'usuarios.update']);

        // Permisos Equipos 
        $permissionPIconfig = Permission::firstOrCreate(['name' => 'pi.index']);
        $permissionPIWebId = Permission::firstOrCreate(['name' => 'pi.WebId']);

        $roleSA->givePermissionTo($permissionEnergiaIndex);
        $roleSA->givePermissionTo($permissionEnergiaEditar);
        $roleSA->givePermissionTo($permissionEnergiaUpdate);
        $roleSA->givePermissionTo($permissionUsuariosIndex);
        $roleSA->givePermissionTo($permissionUsuariosEditar);
        $roleSA->givePermissionTo($permissionUsuariosUpdate);
        $roleSA->givePermissionTo($permissionPIconfig);
        $roleSA->givePermissionTo($permissionPIWebId);

        $roleAdmin->givePermissionTo($permissionEnergiaIndex);
        $roleAdmin->givePermissionTo($permissionEnergiaEditar);
        $roleAdmin->givePermissionTo($permissionEnergiaUpdate);
        $roleAdmin->givePermissionTo($permissionUsuariosIndex);
        $roleAdmin->givePermissionTo($permissionUsuariosEditar);
        $roleAdmin->givePermissionTo($permissionUsuariosUpdate);

        // Permisos al Rol de Usuario
        $roleCOM->givePermissionTo($permissionEnergiaIndex);
        $roleCOM->givePermissionTo($permissionUsuariosIndex);

        $sa->assignRole('sa');
        $admin->assignRole('admin');
    }
}
