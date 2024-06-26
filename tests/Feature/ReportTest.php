<?php

namespace Tests\Feature;

use App\Models\Attendances;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Departments;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ReportTest extends TestCase
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

    public function test_admin_can_generate_and_download_report()
    {
        $this->actingAs($this->admin);
        $users = User::factory()->count(5)->create([
            'department_id' => $this->department->id,
            'shift_id' => $this->shift->id,
        ]);
        $this->assertCount(5, $users);
        foreach ($users as $user) {
            $this->assertNotNull($user->department_id);
            $this->assertNotNull($user->shift_id);
        }

        $startDate = Carbon::parse('2023-06-01');
        $endDate = Carbon::parse('2023-06-30');

        foreach ($users as $user) {
            Attendances::create([
                'user_id' => $user->id,
                'department_id' => $user->department_id,
                'shift_id' => $user->shift_id,
                'date' => Carbon::now()->subDays(5),
            ]);
        }
        $response = $this->post(route('admin.download-pdf'), [
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
        ]);

        $this->assertEquals('text/html; charset=UTF-8', $response->headers->get('content-type'));
        $this->assertNotEmpty($response->getContent());
    }

    public function test_non_admin_cannot_access_admin_report_index()
    {  
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('admin.report'));
        $response->assertStatus(403);
    }


    public function test_non_admin_can_generate_and_download_report()
    {
        $this->actingAs(User::factory()->create());
        
        $startDate = '2023-06-01';
        $endDate = '2023-06-30';

        $response = $this->get(route('admin.download-pdf'), [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        $response->assertStatus(403);
    }
}
