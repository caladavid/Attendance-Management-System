<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Departments;
use App\Models\Shift;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $department;
    protected $shift;

    protected function setUp(): void
    {
        parent::setUp();

        $adminRole = Role::create(['name' => 'Admin']);
        $permission = Permission::create(['name' => 'admin.index']);
        $adminRole->givePermissionTo($permission);

        $this->department = Departments::create([
            'name' => "Finanzas",
        ]);

        $this->shift = Shift::create([
            'name' => "Turno Mañana",
            'start_time' => "08:00:00",
            'end_time' => "12:00:00",
        ]);

        $this->admin = User::factory()->create();
        $this->admin->assignRole('Admin');
    }

    public function test_admin_can_create_a_user()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.users.store'), [
            'first_name' => 'David',
            'last_name' => 'Bowie',
            'email' => 'bowie@correo.com',
            'password' => 'password123',
            'phone' => '04241234567',
            'department_id' => $this->department->id,
            'shift_id' => $this->shift->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'email' => 'bowie@correo.com',
            'first_name' => 'David',
            'last_name' => 'Bowie',
        ]);
    }

    public function test_admin_can_edit_a_user()
    {
        $this->actingAs($this->admin);

        $updatedUserData = [
            'first_name' => 'Kanye',
            'last_name' => 'West',
            'email' => 'west@correo.com',
            'phone' => '04123456999',
            'department_id' => $this->department->id,
            'shift_id' => $this->shift->id,
        ];

        $response = $this->put(route('admin.users.update', $this->admin->id), $updatedUserData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'id' => $this->admin->id,
            'first_name' => 'Kanye',
            'last_name' => 'West',
            'email' => 'west@correo.com',
        ]);
    }

    public function test_admin_can_delete_a_user()
    {
        $this->actingAs($this->admin);

        $user = User::factory()->create();

        $response = $this->delete(route('admin.users.destroy', $user->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_non_admin_cannot_access_admin_users_index()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('admin.users.index'));

        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_create_a_user()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->post(route('admin.users.store'), [
            'first_name' => 'Luis',
            'last_name' => 'Spinetta',
            'email' => 'spinetta@correo.com',
            'password' => 'password123',
            'phone' => '04241234577',
            'department_id' => 1, 
            'shift_id' => 1, 
        ]);
        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_edit_a_user()
    {
        $this->actingAs(User::factory()->create());
        $user = User::factory()->create();
        $response = $this->put(route('admin.users.update', $user->id), [
            'first_name' => 'John',
            'last_name' => 'Lennon',
            'email' => 'lennon@correo.com',
            'password' => '123password123',
            'phone' => '04241123457',
            'department_id' => 2,
            'shift_id' => 2,
        ]);
        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_delete_a_user()
    {
        $this->actingAs(User::factory()->create());
        $user = User::factory()->create();
        $response = $this->delete(route('admin.users.destroy', $user->id));
        $response->assertStatus(403);
    }
}
