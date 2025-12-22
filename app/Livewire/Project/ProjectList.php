<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class ProjectList extends Component
{
    use WithSweetAlert;

    public function checkList($projectId): void
    {
        Project::where('id', $projectId)->update([
            'is_completed' => true,
        ]);

        $this->swalToastSuccess([
            'title' => 'Project checked successfully',
            'icon' => 'success',
            'position' => 'top-end',
            'timer' => 5000,
            'showConfirmButton' => false,
        ]);
    }
    
    public function delete($projectId): void
    {
        Project::where('id', $projectId)->delete();

        $this->swalToastSuccess([
            'title' => 'Project deleted successfully',
            'icon' => 'success',
            'position' => 'top-end',
            'timer' => 5000,
            'showConfirmButton' => false,
        ]);
    }
    
    public function render()
    {
        return view('livewire.project.project-list', [
            'projects' => Project::select('id', 'title', 'description', 'start_date', 'end_date', 'color')->where('is_completed', false)->get(),
        ])->extends('layouts.app');
    }
}
