<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Departments;
use App\Models\Shift;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DepartmentTest extends TestCase
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
            'name' => "IT",
        ]);

        $this->shift = Shift::create([
            'name' => "Turno Mañana",
            'start_time' => "08:00:00",
            'end_time' => "12:00:00",
        ]);

        $this->admin = User::factory()->create();
        $this->admin->assignRole('Admin');
    }

    public function test_admin_can_create_a_department()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.departments.store'), [
            'name' => 'Finanzas',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('departments', [
            'name' => 'Finanzas',
        ]);
    }

    public function test_admin_can_edit_a_department()
    {
        $this->actingAs($this->admin);

        $updatedDepartmentData = [
            'name' => 'Finanzas y Contabilidad',
        ];
        $response = $this->put(route('admin.departments.update', $this->admin->id), $updatedDepartmentData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('departments', [
            'name' => 'Finanzas y Contabilidad',
        ]);
    }

    public function test_admin_can_delete_a_department()
    {
        $this->actingAs($this->admin);
        $departmentData = [
            'name' => 'Finanzas y Contabilidad',
        ];
        $department = Departments::create($departmentData);
        $response = $this->delete(route('admin.departments.destroy', $department->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }

    public function test_non_admin_cannot_access_admin_department_index()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('admin.departments.index'));

        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_create_a_department()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->post(route('admin.departments.store'), [
            'name' => 'Marketing',
        ]);
        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_edit_a_department()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->put(route('admin.departments.update', $this->department->id), [
            'name' => "Marketing",
        ]);
        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_delete_a_department()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->delete(route('admin.departments.destroy', $this->department->id));
        $response->assertStatus(403);
    }
}
