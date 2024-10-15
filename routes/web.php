<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/reports', function () {
    return view('reports');
})->name('reports');


Route::get('/dashboard', function () {
    return view('cpanel.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::patch('/status/{status}', [StatusController::class, 'update'])->name('status.update');
    Route::post('/status', [StatusController::class, 'store'])->name('status.store');
    Route::get('/status', [StatusController::class, 'index'])->name('status');
    Route::delete('/status/{status}', [StatusController::class, 'destroy'])->name('status.destroy');

    Route::patch('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.details');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.details');

});

require __DIR__.'/auth.php';
