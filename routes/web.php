<?php

use App\Http\Controllers\TrackerController;
use App\Http\Livewire\AdminSettings;
use App\Http\Livewire\LocationComponent;
use App\Http\Livewire\TrackerComponent;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', TrackerComponent::class);
Route::get('admin-settings', AdminSettings::class)->name('settings');
Route::get('show/{url}/image', [TrackerController::class, 'tracker'])->name('show.image');
Route::get('login', LocationComponent::class)->name('login');