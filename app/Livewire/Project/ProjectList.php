<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\project_user;
use Illuminate\Support\Facades\Auth;
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
        $projectIds = project_user::where('user_id', Auth::user()->id)->pluck('project_id');
        $query = Project::whereIn('id', $projectIds);

        if(Auth::user()->role === 'owner') {
            $query = Project::query();
        }

        $projectList = (clone $query)->where('is_completed', false)->get();
        
        return view('livewire.project.project-list', [
            'projects' => $projectList,
        ])->extends('layouts.app');
    }
}
