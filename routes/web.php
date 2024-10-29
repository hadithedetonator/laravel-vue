<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

Route::get('/', [HomeController::class, 'index']);
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/todo', [TaskController::class, 'index'])->name('todo.index');
    Route::post('/todo', [TaskController::class, 'store'])->name('todo.store');
    Route::put('/todo/{task}', [TaskController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{task}', [TaskController::class, 'destroy'])->name('todo.destroy');
});