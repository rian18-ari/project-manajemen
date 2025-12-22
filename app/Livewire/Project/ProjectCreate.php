<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectCreate extends Component
{
    public $title;
    public $description;
    public $start_date;
    public $end_date;
    public $color;
    
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'color' => 'required',
        ],[
            'title.required' => 'Please enter a title',
            'description.required' => 'Please enter a description',
            'start_date.required' => 'Please enter a start date',
            'end_date.required' => 'Please enter an end date',
            'color.required' => 'Please enter a color',
        ]);
        
        // $userId = Auth::user()->id;

        // dd($this->all());
        Project::create([
            'user_id' => 1,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'color' => $this->color,
        ]);

        return redirect()->route('project')->with('success', 'Project created successfully');
    }
    
    public function render()
    {
        return view('livewire.project.project-create')->extends('layouts.app');
    }
}
