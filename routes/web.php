<?php

use App\Http\Controllers\TrackerController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('show/{url}/image', [TrackerController::class, 'tracker'])->name('show.image');