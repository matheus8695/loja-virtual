<?php

use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    Route::get("/dashboard", Welcome::class)->name('dashboard');
});

Route::get('/', Welcome::class);
