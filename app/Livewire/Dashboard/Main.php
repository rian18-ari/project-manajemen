<?php

namespace App\Livewire\Dashboard;

use App\Models\Project;
use Carbon\Carbon;
use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        $date = Carbon::now();
        
        return view('livewire.dashboard.main', [
            'projects' => Project::all()->count(),
            'completedProjects' => Project::where('is_completed', true)->count(),
            'notCompletedProjects' => Project::where('is_completed', false)->count(),
            'tasks' => Project::whereMonth('end_date', $date->month)->get(),
        ])->extends('layouts.app');
    }
}
