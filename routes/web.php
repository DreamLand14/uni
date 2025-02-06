<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsStudent;

/* App */
Route::get('/', [AppController::class, 'index']);


/* Auth */
Route::get('/login', [AuthController::class, 'loginPage'])->middleware(['guest'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware(['guest']);
Route::get('/register', [AuthController::class, 'registerPage'])->middleware(['guest']);
Route::post('/register', [AuthController::class, 'register'])->middleware(['guest']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth']);
Route::get('/reset-password', [AuthController::class, 'resetPasswordPage'])->middleware(['guest']);
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware(['guest']);


/* Admin */
Route::prefix('admin')->middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/courses', [AdminController::class, 'courses']);
    Route::get('/course/create', [AdminController::class, 'createCourse']);
    Route::post('/course/store', [AdminController::class, 'storeCourse']);
    Route::get('/course/{course}/edit', [AdminController::class, 'editCourse']);
    Route::post('/course/{course}/update', [AdminController::class, 'updateCourse']);
    Route::get('/course/{course}/delete', [AdminController::class, 'deleteCourse']);
    Route::get('/course/{course}', [AdminController::class, 'showCourse']);
    Route::get('/course/{course}/session/create', [AdminController::class, 'createSession']);
    Route::post('/course/{course}/session/store', [AdminController::class, 'storeSession']);
    Route::get('/session/{session}/delete', [AdminController::class, 'deleteSession']);
    Route::get('/course/{course}/requirement/create', [AdminController::class, 'createRequirement']);
    Route::post('/course/{course}/requirement/store', [AdminController::class, 'storeRequirement']);
    Route::post('/requirement/{requirement}/delete', [AdminController::class, 'deleteRequirement']);
});


/* Student */
Route::prefix('student')->middleware(['auth', EnsureUserIsStudent::class])->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::get('/courses', [StudentController::class, 'courses']);
    Route::get('/course/{course}', [StudentController::class, 'showCourse']);
    Route::post('/course/{course}/enrollment/toggle', [StudentController::class, 'toggleEnrollment']);
    Route::get('/schedule', [StudentController::class, 'schedule']);
    Route::get('/exams', [StudentController::class, 'exams']);
});
