<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CategoryController;

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

    Route::middleware([IsAdmin::class])->group(function () {
        // Instructors
        Route::get('/admin/instructors', [InstructorController::class, 'index'])->name('instructors');
        Route::get('/admin/instructors/add', [InstructorController::class, 'addPage'])->name('instructors.add.page');
        Route::post('/admin/instructors/add', [InstructorController::class, 'store'])->name('instructors.add.post');

        //Categories
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories');
        Route::get('/admin/categories/add', [CategoryController::class, 'addPage'])->name('categories.add.page');
        Route::post('/admin/categories/add', [CategoryController::class, 'store'])->name('categories.add.post');

        // Other admin routes...
    });

});

require __DIR__.'/auth.php';
