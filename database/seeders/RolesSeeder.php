<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Crea los roles si no existen
        $role1 = Role::Create(['name' => 'admin']);
     /*    $role2 = Role::Create(['name' => 'vendedor']); */
        $role2 = Role::Create(['name' => 'cliente']);

        Permission::create(['name' => 'admin.users.index','description'=>'Ver los Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit','description'=>'Editar Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update','description'=>'Actualizar Usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.roles.index','description'=>'Ver los Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.create','description'=>'Crear Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit','description'=>'Actualizar Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.destroy','description'=>'Eliminar Roles'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.brands.index','description'=>'Ver las Marcas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.brands.list','description'=>'Listar las Marcas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.brands.store','description'=>'Crear Marcas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.brands.update','description'=>'Actualizar Marcas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.brands.destroy','description'=>'Eliminar Marcas'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.types.index','description'=>'Ver los Tipos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.types.list','description'=>'Listar los Tipos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.types.store','description'=>'Crear Tipos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.types.update','description'=>'Actualizar Tipos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.types.destroy','description'=>'Eliminar Tipos'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.vehicles.index','description'=>'Ver los Vehículos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.vehicles.list','description'=>'Listar los Vehículos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.vehicles.store','description'=>'Crear Vehículos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.vehicles.update','description'=>'Actualizar Vehículos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.vehicles.destroy','description'=>'Eliminar Vehículos'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.prices.index','description'=>'Ver los Precios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.prices.list','description'=>'Listar los Precios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.prices.store','description'=>'Crear Precios'])->syncRoles([$role1, $role2]);


    }
}
