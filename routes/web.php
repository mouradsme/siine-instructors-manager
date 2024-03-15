<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/elements/unverified', [ElementController::class, 'unverified'])->name('unverified');
    Route::get('/elements/approved', [ElementController::class, 'approved'])->name('approved');
    Route::get('/elements/approved/view/{id}', [ElementController::class, 'approvedElementPage'])->name('approved.element.page');
    Route::get('/elements/unverified/edit/{id}', [ElementController::class, 'verifyElementPage'])->name('unverified.verify.page');
    Route::post('/elements/unverified/edit', [ElementController::class, 'updateElement'])->name('unverified.edit.post');
    Route::post('/elements/unverified/addNote', [ElementController::class, 'addNote'])->name('notes.add.post');

    Route::get('/notes/delete/{id}', [NoteController::class, 'delete'])->name('note.delete.post');

    Route::middleware([IsAdmin::class])->group(function () {
        // Instructors
        Route::get('/admin/instructors', [InstructorController::class, 'index'])->name('instructors');
        Route::get('/admin/instructors/add', [InstructorController::class, 'addPage'])->name('instructors.add.page');
        Route::post('/admin/instructors/add', [InstructorController::class, 'store'])->name('instructors.add.post');

        Route::get('/admin/instructors/edit/{id}', [InstructorController::class, 'editPage'])->name('instructors.edit.page');
        Route::post('/admin/instructors/edit', [InstructorController::class, 'update'])->name('instructors.edit.post');

        //Categories
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories');
        Route::get('/admin/categories/add', [CategoryController::class, 'addPage'])->name('categories.add.page');
        Route::post('/admin/categories/add', [CategoryController::class, 'store'])->name('categories.add.post');

        //Elements
        Route::get('/admin/elements', [ElementController::class, 'index'])->name('elements');
        Route::get('/admin/elements/add', [ElementController::class, 'addPage'])->name('elements.add.page');
        Route::post('/admin/elements/add', [ElementController::class, 'store'])->name('elements.add.post');

        // Other routes...


    });

});

require __DIR__.'/auth.php';
