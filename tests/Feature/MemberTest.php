<?php

namespace Tests\Feature;

use App\Livewire\Member\Main;
use App\Models\Project;
use App\Models\project_user;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_member_page()
    {
        $user = User::factory()->create(['role' => 'member']);

        $this->actingAs($user)
            ->get(route('member'))
            ->assertStatus(200)
            ->assertSeeLivewire(Main::class);
    }

    /** @test */
    public function it_calculates_member_stats_correctly()
    {
        $user = User::factory()->create(['role' => 'member']);

        $project1 = Project::create([
            'user_id' => $user->id,
            'title' => 'Project 1',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-01',
            'color' => '#000',
            'is_completed' => true
        ]);

        $project2 = Project::create([
            'user_id' => $user->id,
            'title' => 'Project 2',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-01',
            'color' => '#000',
            'is_completed' => false
        ]);

        project_user::create(['project_id' => $project1->id, 'user_id' => $user->id]);
        project_user::create(['project_id' => $project2->id, 'user_id' => $user->id]);

        Livewire::actingAs($user)
            ->test(Main::class)
            ->assertViewHas('projects', 2)
            ->assertViewHas('completedProjects', 1)
            ->assertViewHas('notCompletedProjects', 1);
    }
}
