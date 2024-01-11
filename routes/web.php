<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index']);
        Route::post('/', [ClientController::class, 'create'])->middleware('auth');
        Route::put('/{id}', [ClientController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('/{id}', [ClientController::class, 'delete'])->where('id', '[0-9]+');

        Route::prefix('{idClient}/projects')->group(function () {
            Route::get('/', [ProjectController::class, 'index'])->where('idClient', '[0-9]+');
            Route::post('/', [ProjectController::class, 'create'])->where('idClient', '[0-9]+');
            Route::put('/{idProject}', [ProjectController::class, 'update'])
                ->where('idClient', '[0-9]+')
                ->where('idProject', '[0-9]+');
            Route::delete('/{idProject}', [ProjectController::class, 'delete'])
                ->where('idClient', '[0-9]+')
                ->where('idProject', '[0-9]+');
        });
    });

    Route::get('/private', function () {
        $user = auth()->user();
        $name = $user->name ?? 'User';
        $email = $user->email ?? '';

        return response('Welcome! You are logged in. Your name is ' . $name . ' and your email is ' . $email . '.');
    });
});
