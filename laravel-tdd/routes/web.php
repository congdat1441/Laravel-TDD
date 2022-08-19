<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index'])
    ->name('tasks.index');

Route::post('/tasks', [\App\Http\Controllers\TaskController::class, 'store'])
    ->name('tasks.store')
    ->middleware('auth');

Route::get('/tasks/create',[\App\Http\Controllers\TaskController::class, 'create'])
    ->name('tasks.create')
    ->middleware('auth');

Route::get('/tasks/{id}/edit',[\App\Http\Controllers\TaskController::class, 'edit'])
    ->name('tasks.edit')
    ->middleware('auth');

Route::put('/tasks/{id}/update',[\App\Http\Controllers\TaskController::class, 'update'])
    ->name('tasks.update')
    ->middleware('auth');

Route::delete('/tasks/{id}',[\App\Http\Controllers\TaskController::class, 'destroy'])
    ->name('tasks.destroy')
    ->middleware('auth');

Route::get('/tasks/{id}', [\App\Http\Controllers\TaskController::class, 'show'])
    ->name('tasks.show')
    ->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

