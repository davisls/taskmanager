<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

Route::get('/', [HomeController::class, 'home'])->middleware('auth');
Route::get('/cadastrar', [HomeController::class, 'cadastrar'])->middleware('auth');

Route::post('/store', [TaskController::class, 'store'])->middleware('auth');
Route::get('/detalhes/{id}', [TaskController::class, 'show'])->middleware('auth');
Route::get('/tarefas/{id}', [TaskController::class, 'tarefas'])->middleware('auth');
Route::get('/filter/{filtro}', [TaskController::class, 'filter'])->middleware('auth');
Route::get('/concluida/{id}', [TaskController::class, 'concluida'])->middleware('auth');
Route::get('/editar/{id}', [TaskController::class, 'edit'])->middleware('auth');
Route::put('/update', [TaskController::class, 'update'])->middleware('auth');
Route::delete('/delete/{id}', [TaskController::class, 'destroy'])->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'home'])->name('home');
