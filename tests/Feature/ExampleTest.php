<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders(): void
    {
        $this->get(route('landing'))
            ->assertStatus(200);
    }

    public function test_admin_dashboard_renders(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->followingRedirects()
            ->get(route('admin.dashboard'))
            ->assertStatus(200);
    }

    public function test_companies_index_renders(): void
    {
        $user = User::factory()->create();

        $companies = Company::factory(10)->create();

        $this->actingAs($user)
            ->followingRedirects()
            ->get(route('companies.index'))
            ->assertStatus(200);
    }

    public function test_employees_index_renders(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->get(route('employees.index'));
        $response->assertStatus(200);
    }
}
