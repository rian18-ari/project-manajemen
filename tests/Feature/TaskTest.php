<?php

namespace Tests\Feature;

use App\Livewire\Project\TaskAdd;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_add_task_page()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $project = Project::create([
            'user_id' => $user->id,
            'title' => 'Project for Task',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-01',
            'color' => '#000',
        ]);

        $this->actingAs($user)
            ->get(route('task.add', $project->id))
            ->assertStatus(200)
            ->assertSeeLivewire(TaskAdd::class);
    }

    /** @test */
    public function it_can_create_a_task()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $project = Project::create([
            'user_id' => $user->id,
            'title' => 'Project for Task',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-01',
            'color' => '#000',
        ]);

        Livewire::actingAs($user)
            ->test(TaskAdd::class, ['id' => $project->id])
            ->set('title', 'New Task')
            ->set('description', 'Task Description')
            ->call('store')
            ->assertRedirect(route('project.show', $project->id));

        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'project_id' => $project->id,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_validates_task_creation()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $project = Project::create([
            'user_id' => $user->id,
            'title' => 'Project for Task',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-01',
            'color' => '#000',
        ]);

        Livewire::actingAs($user)
            ->test(TaskAdd::class, ['id' => $project->id])
            ->set('title', '')
            ->call('store')
            ->assertHasErrors(['title' => 'required']);
    }
}
