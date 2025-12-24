<?php

namespace App\Livewire\Dashboard;

use App\Models\Project;
use App\Models\project_user;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        $month = Carbon::now()->month;
        
        $ids = Auth::user()->id;
        $projectIds = project_user::where('user_id', $ids)->pluck('project_id');
        $query = Project::whereIn('id', $projectIds);

        if(Auth::user()->role === 'owner'){
            $query = Project::query();
        }

        $projects = (clone $query)->count();
        $completedProjects = (clone $query)->where('is_completed', true)->count();
        $notCompletedProjects = (clone $query)->where('is_completed', false)->count();
        $tasks = (clone $query)->whereMonth('end_date', $month)->where('is_completed', false)->get();
        
        return view('livewire.dashboard.main', [
            'projects' => $projects,
            'completedProjects' => $completedProjects,
            'notCompletedProjects' => $notCompletedProjects,
            'tasks' => $tasks,
        ])->extends('layouts.app');
    }
}
