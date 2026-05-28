<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// GET - fetch all students
Route::get('/students', [StudentController::class, 'index']);

// GET - fetch one student by ID
Route::get('/students/{id}', [StudentController::class, 'show']);

// POST - create a new student
Route::post('/students', [StudentController::class, 'store']);

// PUT - update an existing student by ID
Route::put('/students/{id}', [StudentController::class, 'update']);

// PATCH - partial update of an existing student by ID
Route::patch('/students/{id}', [StudentController::class, 'patch']);

// DELETE - delete all students
Route::delete('/students', [StudentController::class, 'destroyAll']);

// DELETE - delete one student by ID
Route::delete('/students/{id}', [StudentController::class, 'destroy']);