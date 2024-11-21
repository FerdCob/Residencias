<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', WelcomeController::class)->name('home');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');


Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
});
//Si no funciona, descomentar la siguiente linea
Route::get('prueba', function () {
    return Storage::files('posts');
});
