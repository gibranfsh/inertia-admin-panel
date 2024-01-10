<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return inertia::render('create');
});

Route::get('/private', function () {
    $user = auth()->user();
    $name = $user->name ?? 'User';
    $email = $user->email ?? '';

    return response('Welcome! You are logged in. Your name is ' . $name . ' and your email is ' . $email . '.');
})->middleware('auth');
