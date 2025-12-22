<?php

namespace App\Livewire\Project;

use App\Models\Project as projects;
use App\Models\project_user;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class Project extends Component
{
    use WithSweetAlert;
    public $taskId;
    public $projectId;
    public $search = '';

    public function mount($id)
    {
        $this->projectId = $id;
    }

    public function updateTaskStatus($taskId): void
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->is_completed = !$task->is_completed;
            $task->save();
        } else {
        }

        $this->swalToastSuccess([
            'title' => 'Data berhasil diperbarui!',
            'position' => 'top-end',
            'timer' => 2000,
            'showConfirmButton' => false,
        ]);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Task::create([
            'project_id' => $this->projectId,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        return redirect()->route('project.show', $this->projectId);
    }

    public function inviteMember($userId)
    {
        project_user::create([
            'project_id' => $this->projectId,
            'user_id' => $userId,
        ]);

        $this->search = '';
        $this->dispatch('close-modal');

        $this->swalToastSuccess([
            'title' => 'Undangan berhasil dikirim!',
            'position' => 'top-end',
            'timer' => 2000,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        $searchResults = [];
        if (strlen($this->search) >= 3) {
            $searchResults = User::where('name', 'like', '%' . $this->search . '%')
                ->where('id', '!=', auth()->id())
                ->limit(5)
                ->get();
        }

        $projects = projects::select('start_date', 'end_date')->where('id', $this->projectId)->first();
        $totalTasks = Task::selectRaw('(AVG(is_completed) * 100) AS completion_percentage')->where('project_id', $this->projectId)->first();
        $assigneesIds = project_user::where('project_id', $this->projectId)
            ->pluck('user_id')
            ->toArray();
        $assignees = User::whereIn('id', $assigneesIds)->get();

        return view('livewire.project.project', [
            'tasks' => Task::where('project_id', $this->projectId)->select('id', 'title', 'description', 'is_completed')->get(),
            'projectDate' => $projects,
            'totalTasks' => $totalTasks->completion_percentage,
            'searchResults' => $searchResults,
            'projectId' => $this->projectId,
            'projectTitlw' => projects::select('title', 'color')->where('id', $this->projectId)->first(),
            'assignees' => $assignees,
        ])->extends('layouts.app');
    }
}
