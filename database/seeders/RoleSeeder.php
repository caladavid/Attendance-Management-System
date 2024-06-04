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
     */
    public function run(): void
    {
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleEmpleado = Role::firstOrCreate(['name' => 'Empleado']);

        Permission::create(['name' => 'admin.index'])->assignRole($roleAdmin);
/*         Permission::create(['name' => 'admin.create'])->assignRole($role);
        Permission::create(['name' => 'admin.edit'])->assignRole($role);
        Permission::create(['name' => 'admin.destroy'])->assignRole($role); */
/*         Permission::create(['name' => 'admin.departments'])->assignRole($role); */
    }
}
