<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/dashboard/add', [AdminController::class, 'add'])->name('admin/dashboard/add');
    Route::post('/admin/dashboard/save', [AdminController::class, 'save'])->name('admin/dashboard/save');
    Route::get('/admin/dashboard/edit/{id}', [AdminController::class, 'edit'])->name('admin/dashboard/edit');
    Route::put('/admin/dashboard/edit/{id}', [AdminController::class, 'update'])->name('admin/dashboard/update');
    Route::get('/admin/dashboard/delete/{id}', [AdminController::class, 'delete'])->name('admin/dashboard/delete');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

require __DIR__.'/auth.php';


