<?php

use App\Livewire\Auth;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    Route::get("/dashboard", Welcome::class)->name('dashboard');
});

Route::get('/', Welcome::class);
Route::get('/cadastrar', Auth\Register::class)->name('register');
