<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Dashboard\Main;
use App\Livewire\Member\Main as MemberMain;
use App\Livewire\Project\Project;
use App\Livewire\Project\ProjectCompleted;
use App\Livewire\Project\ProjectCreate;
use App\Livewire\Project\ProjectList;
use App\Livewire\Project\TaskAdd;
use App\Livewire\Setting\SettingMenu;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('home');
Route::get('/main', Main::class)->name('main');
Route::get('/project', ProjectList::class)->name('project')->middleware('auth', 'role:owner,member');
Route::get('/project/create', ProjectCreate::class)->name('project.create')->middleware('auth', 'role:owner,member');
Route::get('/project/{id}', Project::class)->name('project.show')->middleware('auth', 'role:owner,member');
Route::get('/project/{id}/addtask', TaskAdd::class)->name('task.add')->middleware('auth', 'role:owner,member');
Route::get('/projectNotCompleted', ProjectCompleted::class)->name('project.not-completed')->middleware('auth', 'role:owner,member');
Route::get('/member', MemberMain::class)->name('member')->middleware('role:owner,member');
Route::get('/setting', SettingMenu::class)->name('setting')->middleware('role:owner,member');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
