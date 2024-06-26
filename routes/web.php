<?php

use App\Http\Controllers\CreateRolesAndAssignTheUsers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-roles-users', [CreateRolesAndAssignTheUsers::class, 'createRolesAndUsers']);
Route::get('/show-user-with-roles', [CreateRolesAndAssignTheUsers::class, 'showUsersWithRoles'])->name('showUserWithRoles');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
