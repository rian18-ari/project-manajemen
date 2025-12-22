<?php

namespace App\Livewire\Project;

use App\Models\Project as projects;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class Project extends Component
{
    use WithSweetAlert;
    public $taskId;
    public $projectId;

    public function mount($id)
    {
        $this->projectId = $id;
    }
    
    public function updateTaskStatus($taskId): void
    {
        $task = Task::find($taskId);
        if ($task) {
            // Jika ditemukan, baru lakukan operasi toggle dan save
            $task->is_completed = !$task->is_completed;
            $task->save();

            // Opsional: Kirim notifikasi sukses atau log
            // session()->flash('message', 'Status tugas berhasil diperbarui!');
        } else {
            // Jika tidak ditemukan, tangani error atau abaikan
            // Opsional: Kirim notifikasi error atau log
            // session()->flash('error', 'Tugas tidak ditemukan.');
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
            'label_id' => $this->label_id,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        return redirect()->route('project.show', $this->projectId);
    }

    public function render()
    {
        $projects = projects::select('start_date', 'end_date')->where('id', $this->projectId)->first();
        $totalTasks = Task::selectRaw('(AVG(is_completed) * 100) AS completion_percentage')->where('project_id', $this->projectId)->first();

        return view('livewire.project.project', [
            'tasks' => Task::where('project_id', $this->projectId)->select('id', 'title', 'description', 'is_completed')->get(),
            'projectDate' => $projects,
            'totalTasks' => $totalTasks->completion_percentage,
            'projectId' => $this->projectId,
            'projectTitlw' => projects::select('title', 'color')->where('id', $this->projectId)->first(),
        ])->extends('layouts.app');
    }
}
