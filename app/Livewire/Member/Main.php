<?php

namespace App\Livewire\Member;

use App\Models\Project;
use App\Models\project_user;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        $userIds = Auth::user()->id;
        $projectIds = project_user::where('user_id', $userIds)->pluck('project_id');
        
        return view('livewire.member.main',[
            'projects' => Project::whereIn('id', $projectIds)->count(),
            'completedProjects' => Project::whereIn('id', $projectIds)->where('is_completed', true)->count(),
            'notCompletedProjects' => Project::whereIn('id', $projectIds)->where('is_completed', false)->count(),
            'tasks' => Project::whereIn('id', $projectIds)->with('tasks')->get(),
        ])->extends('layouts.app');
    }
}
