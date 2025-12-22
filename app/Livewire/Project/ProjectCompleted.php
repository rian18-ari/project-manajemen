<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class ProjectCompleted extends Component
{
    public function render()
    {
        return view('livewire.project.project-completed',[
            'projects' => Project::select('id', 'title', 'description', 'start_date', 'end_date', 'color')->where('is_completed', true)->get(),
        ])->extends('layouts.app');
    }
}
