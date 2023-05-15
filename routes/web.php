<?php

use App\Http\Controllers\TrackerController;
use App\Http\Livewire\LocationComponent;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('show/{url}/image', [TrackerController::class, 'tracker'])->name('show.image');
Route::get('login', LocationComponent::class)->name('login');