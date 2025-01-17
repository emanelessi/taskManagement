<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttachmentController;
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
Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('language');


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('cpanel.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//Route::get('/check-permissions', function () {
//    $user = auth()->user();
//    return [
//        'roles' => $user->getRoleNames(),
//        'permissions' => $user->getAllPermissions(),
//    ];
//});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::get('/projects/{project}/tasks', [TaskController::class, 'tasksByProject'])->name('projects.tasks');

    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.details');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::post('/tasks/{task}/update-category', [TaskController::class, 'updateCategory']);


    Route::get('/project-report', [ProjectController::class, 'projectReport'])->name('project.report');
    Route::post('/project-pdf', [ProjectController::class, 'projectPdf'])->name('project.pdf');

    Route::get('/task-report', [TaskController::class, 'taskReport'])->name('task.report');
    Route::post('/task-pdf', [TaskController::class, 'taskPdf'])->name('task.pdf');
    Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])->name('attachment.destroy');

    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});

require __DIR__.'/auth.php';
