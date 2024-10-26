<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
       $role1 = Role::create(['name' => 'admin']);
       $role2 = Role::create(['name' => 'cliente']);

       Permission::create(['name' => 'admin.inicio'])->syncRoles([$role1]);
       
       Permission::create(['name' => 'admin.cliente.index'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.cliente.create'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.cliente.edit'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.cliente.destroy'])->syncRoles([$role1,$role2]);
       
       Permission::create(['name' => 'admin.calzado.index'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.calzado.create'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.calzado.edit'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.calzado.destroy'])->syncRoles([$role1,$role2]);

       Permission::create(['name' => 'admin.venta.index'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.venta.create'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.venta.edit'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.venta.destroy'])->syncRoles([$role1,$role2]);

       Permission::create(['name' => 'admin.compra.index'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.compra.create'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.compra.edit'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.compra.destroy'])->syncRoles([$role1,$role2]);

    }
}
