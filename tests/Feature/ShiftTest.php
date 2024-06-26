<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Departments;
use App\Models\Shift;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ShiftTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $department;
    protected $shiftSetUp;
    
    protected function setUp(): void
    {
        parent::setUp();

        $adminRole = Role::create(['name' => 'Admin']);
        $permission = Permission::create(['name' => 'admin.index']);
        $adminRole->givePermissionTo($permission);

        $this->department = Departments::create([
            'name' => "IT",
        ]);

        $this->shiftSetUp = Shift::create([
            'name' => "Turno - Todo el dia",
            'start_time' => "08:00",
            'end_time' => "4:00",
        ]);

        $this->admin = User::factory()->create();
        $this->admin->assignRole('Admin');
    }

    public function test_admin_can_create_a_shift()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.shift.store'), [
            'name' => "Turno Mañana",
            'start_time' => "08:00",
            'end_time' => "12:00",
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('shifts', [
            'name' => "Turno Mañana",
            'start_time' => "08:00",
            'end_time' => "12:00",
        ]);
    }

    public function test_admin_can_edit_a_shift()
    {
        $this->actingAs($this->admin);

        $updatedShiftData = [
            'name' => "Turno Tarde",
            'start_time' => "12:00:00",
            'end_time' => "06:00:00",
        ];
        $response = $this->put(route('admin.shift.update', $this->admin->id), $updatedShiftData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('shifts', [
            'name' => "Turno Tarde",
            'start_time' => "12:00:00",
            'end_time' => "06:00:00",
        ]);
    }

    public function test_admin_can_delete_a_shift()
    {
        $this->actingAs($this->admin);
        $shiftData = [
            'name' => "Turno - Tarde",
            'start_time' => "12:00",
            'end_time' => "06:00",
        ];
        $shift = Shift::create($shiftData);
        $response = $this->delete(route('admin.shift.destroy', $shift->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('departments', ['id' => $shift->id]);
    }

    public function test_non_admin_cannot_access_admin_shift_index()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('admin.shift.index'));

        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_create_a_shift()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->post(route('admin.shift.store'), [
            'name' => "Turno - Tarde",
            'start_time' => "12:00",
            'end_time' => "06:00",
        ]);
        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_edit_a_shift()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->put(route('admin.shift.update', $this->shiftSetUp->id), [
            'name' => "Turno - Todo el dia",
            'start_time' => "08:00",
            'end_time' => "04:00",
        ]);
        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_delete_a_shift()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->delete(route('admin.shift.destroy', $this->shiftSetUp->id));
        $response->assertStatus(403);
    }
}
