<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth as Admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create');
        Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
        Route::get('/todo/{id}/edit', [TodoController::class, 'edit'])->name('todo.edit');
        Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
        Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
    });

// Auth as User
Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::patch('/todo/{id}/done', [ToDoController::class, 'markDone'])->name('todo.markDone');
});

require __DIR__ . '/auth.php';
