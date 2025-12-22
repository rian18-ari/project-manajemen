<?php

namespace App\Livewire\Project;

use App\Models\Task;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class TaskAdd extends Component
{
    use WithSweetAlert;

    public $title;
    public $description;
    public $projectId;
    public $user_id;

    public function mount($id)
    {
        $this->projectId = $id;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Task::create([
            'project_id' => $this->projectId,
            'user_id' => 1,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        return redirect()->route('project.show', $this->projectId);
    }

    public function render()
    {
        return view('livewire.project.task-add', [
            'projectId' => $this->projectId,
        ])->extends('layouts.app');
    }
}
