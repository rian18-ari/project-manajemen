<?php

namespace Tests\Feature;

use App\Livewire\Dashboard\Main;
use App\Models\Project;
use App\Models\project_user;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_dashboard_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('main'))
            ->assertStatus(200)
            ->assertSeeLivewire(Main::class);
    }

    /** @test */
    public function it_calculates_dashboard_stats_correctly_for_owner()
    {
        $owner = User::factory()->create(['role' => 'owner']);

        Project::create([
            'user_id' => $owner->id,
            'title' => 'Project 1',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => Carbon::now()->addDays(5),
            'color' => '#000',
            'is_completed' => true
        ]);

        Project::create([
            'user_id' => $owner->id,
            'title' => 'Project 2',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => Carbon::now()->addDays(5),
            'color' => '#000',
            'is_completed' => false
        ]);

        Livewire::actingAs($owner)
            ->test(Main::class)
            ->assertViewHas('projects', 2)
            ->assertViewHas('completedProjects', 1)
            ->assertViewHas('notCompletedProjects', 1);
    }

    /** @test */
    public function it_calculates_dashboard_stats_correctly_for_member()
    {
        $member = User::factory()->create(['role' => 'member']);
        $owner = User::factory()->create(['role' => 'owner']);

        $project1 = Project::create([
            'user_id' => $owner->id,
            'title' => 'Project 1',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => Carbon::now()->addDays(5),
            'color' => '#000',
            'is_completed' => true
        ]);

        $project2 = Project::create([
            'user_id' => $owner->id,
            'title' => 'Project 2',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => Carbon::now()->addDays(5),
            'color' => '#000',
            'is_completed' => false
        ]);

        // Assign only project 2 to member
        project_user::create(['project_id' => $project2->id, 'user_id' => $member->id]);

        Livewire::actingAs($member)
            ->test(Main::class)
            ->assertViewHas('projects', 1)
            ->assertViewHas('completedProjects', 0)
            ->assertViewHas('notCompletedProjects', 1);
    }
}
