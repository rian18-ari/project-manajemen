<?php

namespace Tests\Feature;

use App\Livewire\Project\Project;
use App\Livewire\Project\ProjectCreate;
use App\Livewire\Project\ProjectList;
use App\Models\User;
use App\Models\Project as ProjectModel;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_project_list_page()
    {
        $user = User::factory()->create(['role' => 'member']);

        $this->actingAs($user)
            ->get(route('project'))
            ->assertStatus(200)
            ->assertSeeLivewire(ProjectList::class);
    }

    /** @test */
    public function it_can_create_a_project()
    {
        $user = User::factory()->create(['role' => 'owner']);

        Livewire::actingAs($user)
            ->test(ProjectCreate::class)
            ->set('title', 'New Project')
            ->set('description', 'Project Description')
            ->set('start_date', '2023-01-01')
            ->set('end_date', '2023-01-31')
            ->set('color', '#FF0000')
            ->call('store')
            ->assertRedirect(route('project'));

        $this->assertDatabaseHas('projects', [
            'title' => 'New Project',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_validates_project_creation()
    {
        $user = User::factory()->create(['role' => 'owner']);

        Livewire::actingAs($user)
            ->test(ProjectCreate::class)
            ->set('title', '')
            ->call('store')
            ->assertHasErrors(['title' => 'required']);
    }

    /** @test */
    public function it_can_delete_a_project()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $project = ProjectModel::create([
            'user_id' => $user->id,
            'title' => 'Project to Delete',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-01',
            'color' => '#000',
        ]);

        Livewire::actingAs($user)
            ->test(ProjectList::class)
            ->call('delete', $project->id);

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    /** @test */
    public function it_can_mark_project_as_completed()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $project = ProjectModel::create([
            'user_id' => $user->id,
            'title' => 'Project to Complete',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-01',
            'color' => '#000',
            'is_completed' => false,
        ]);

        Livewire::actingAs($user)
            ->test(ProjectList::class)
            ->call('checkList', $project->id);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'is_completed' => true,
        ]);
    }

    /** @test */
    public function it_can_render_project_details_page()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $project = ProjectModel::create([
            'user_id' => $user->id,
            'title' => 'Project Details',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-01',
            'color' => '#000',
        ]);

        $this->actingAs($user)
            ->get(route('project.show', $project->id))
            ->assertStatus(200)
            ->assertSeeLivewire(Project::class);
    }

    /** @test */
    public function it_can_toggle_task_status_in_project_details()
    {
        $user = User::factory()->create(['role' => 'owner']);
        $project = ProjectModel::create([
            'user_id' => $user->id,
            'title' => 'Project with Task',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-01',
            'color' => '#000',
        ]);

        $task = Task::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Task 1',
            'description' => 'Desc',
            'is_completed' => false,
        ]);

        Livewire::actingAs($user)
            ->test(Project::class, ['id' => $project->id])
            ->call('updateTaskStatus', $task->id);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'is_completed' => true,
        ]);
    }
}
