<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleEmpleado = Role::firstOrCreate(['name' => 'Empleado']);

        Permission::create(['name' => 'admin.index'])->assignRole($roleAdmin);

    }
}
