<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Departments;
use App\Models\Shift;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*         $this->call(RoleSeeder::class); */
        $department = new Departments();
        $department->name = 'Recursos Humanos';
        $department->save();

        $shift = new Shift();
        $shift->name = 'Turno de la mañana | Lunes a Viernes';
        $shift->start_time = '08:00:00';
        $shift->end_time = '12:00:00';
        $shift->save();

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'admin@correo.com',
            'password' => bcrypt('admin123'),
            'phone' => '04245555555',
            'joining_date' => Carbon::now(),
            'department_id' => $department->id,
            'shift_id' => $shift->id,
        ])->assignRole('Admin');;

        User::factory(10)->create([
            'department_id' => $department->id,
            'shift_id' => $shift->id,
        ]);
    }
}
