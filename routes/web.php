<?php

use App\Livewire\Product;
use App\Livewire\{Auth, Dashboard, UserProfile};
use Illuminate\Support\Facades\Route;

Route::get('/cadastrar', Auth\Register::class)->name('register');
Route::get("/entrar", Auth\Login::class)->name('login');
Route::get("/logout", Auth\Logout::class)->name('logout');

Route::middleware('auth')->group(function (): void {
    // Route::get("/", Welcome::class)->name('dashboard'); // tela inicial com os produtos
    Route::get('/', Dashboard::class)->name('dashboard');

    #profile
    Route::get('/minha_conta', UserProfile\Index::class)->name('user-profile.index');
    #end profile

    #product
    Route::get('produto/{encodedId}', Product\Index::class)->name('product.index');
    #end product
});
