<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\project_user;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectCompleted extends Component
{
    public function render()
    {
        $projectIds = project_user::where('user_id', Auth::user()->id)->pluck('project_id');
        $query = Project::whereIn('id', $projectIds);
        
        if(Auth::user()->role === 'owner') {
            $query = Project::query();
        }

        $projectList = (clone $query)->where('is_completed', true)->get();
        
        return view('livewire.project.project-completed',[
            'projects' => $projectList,
        ])->extends('layouts.app');
    }
}
