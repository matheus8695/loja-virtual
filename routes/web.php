<?php

use App\Livewire\{Auth, UserProfile, Welcome};
use Illuminate\Support\Facades\Route;

Route::get('/cadastrar', Auth\Register::class)->name('register');
Route::get("/entrar", Auth\Login::class)->name('login');
Route::get("/logout", Auth\Logout::class)->name('logout');

Route::middleware('auth')->group(function () {
    Route::get("/", Welcome::class)->name('dashboard'); // tela inicial com os produtos

    #profile
    Route::get('/minha_conta', UserProfile\Show::class)->name('user-profile.show');
    #end profile
});
