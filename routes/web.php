<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\TeacherController;

// ------------------- RUTA PRINCIPAL -------------------
// Cambiado para usar el método listar que sí existe
Route::get('/', [FacultyController::class, 'listar'])->name('home');


// ------------------- FACULTY -------------------
Route::get('/faculties', [FacultyController::class, 'listar'])->name('faculties.listar');
Route::get('/faculties/nuevo', [FacultyController::class, 'nuevo'])->name('faculties.nuevo');
Route::post('/faculties/guardar', [FacultyController::class, 'guardar'])->name('faculties.guardar');
Route::get('/faculties/editar/{id}', [FacultyController::class, 'editar'])->name('faculties.editar');
Route::post('/faculties/procesar-edicion/{id}', [FacultyController::class, 'procesarEdicion'])->name('faculties.procesarEdicion');
Route::get('/faculties/eliminar/{id}', [FacultyController::class, 'eliminar'])->name('faculties.eliminar');
Route::get('/faculties/{id}', [FacultyController::class, 'show'])->name('faculties.show');


// ------------------- CAREER -------------------
Route::get('/careers', [CareerController::class, 'listar'])->name('careers.listar');
Route::get('/careers/nuevo', [CareerController::class, 'nuevo'])->name('careers.nuevo');
Route::post('/careers/guardar', [CareerController::class, 'guardar'])->name('careers.guardar');
Route::get('/careers/editar/{id}', [CareerController::class, 'editar'])->name('careers.editar');
Route::post('/careers/procesar-edicion/{id}', [CareerController::class, 'procesarEdicion'])->name('careers.procesarEdicion');
Route::get('/careers/eliminar/{id}', [CareerController::class, 'eliminar'])->name('careers.eliminar');
Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');


// ------------------- TEACHER -------------------
Route::get('/teachers', [TeacherController::class, 'listar'])->name('teachers.listar');
Route::get('/teachers/nuevo', [TeacherController::class, 'nuevo'])->name('teachers.nuevo');
Route::post('/teachers/guardar', [TeacherController::class, 'guardar'])->name('teachers.guardar');
Route::get('/teachers/editar/{id}', [TeacherController::class, 'editar'])->name('teachers.editar');
Route::post('/teachers/procesar-edicion/{id}', [TeacherController::class, 'procesarEdicion'])->name('teachers.procesarEdicion');
Route::get('/teachers/eliminar/{id}', [TeacherController::class, 'eliminar'])->name('teachers.eliminar');
Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('teachers.show');
