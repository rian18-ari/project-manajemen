<?php

namespace App\Livewire\Setting;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SettingMenu extends Component
{
    public function render()
    {
        $userIDS = Auth::user()->id;
        
        return view('livewire.setting.setting-menu', [
            'name' => User::where('id', $userIDS)->select('name')->first(),
            'email' => User::where('id', $userIDS)->select('email')->first(),
            'role' => User::where('id', $userIDS)->select('role')->first(),
        ])->extends('layouts.base');
    }
}
