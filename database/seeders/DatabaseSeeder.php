<?php

namespace Database\Seeders;

use App\Models\Departments;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

/*         $department = new Departments();
        $department->name = 'Marketing';
        $department->save();

        $user = new User();
        $user->first_name = 'John';
        $user->last_name = 'Doe';
        $user->email = 'admin@correo.com';
        $user->password = bcrypt('admin123');
        $user->phone = '04245555555';
        $user->joining_date = Carbon::now();
        $user->department_id = $department->id;

        $user->assignRole('Admin');
        $user->save();

        User::factory(10)->create(); */

/*         User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'Admin',
            'email' => 'test@example.com',
            'password' => bcrypt('admin123'),
            'phone' => '04245555555',
            'joining_date' => Carbon::now(),
            'department_id' => '1',
        ]); */
    }
}
