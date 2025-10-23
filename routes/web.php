<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;

// Ruta principal del sitio: muestra las facultades
Route::get('/', [FacultyController::class, 'index'])->name('home');

// CRUD completo de facultades
Route::resource('faculties', FacultyController::class);

