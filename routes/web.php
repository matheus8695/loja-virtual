<?php

use App\Livewire\{Auth, Welcome};
use Illuminate\Support\Facades\Route;

Route::get('/cadastrar', Auth\Register::class)->name('register');
Route::get("/entrar", Auth\Login::class)->name('login');
Route::get("/logout", fn () => auth()->logout() && to_route('login'))->name('logout');

Route::middleware('auth')->group(function () {
    Route::get("/", Welcome::class)->name('dashboard');
});
