<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SystemInfoController;
use App\Http\Livewire\Pages\CreateUser;
use App\Models\User;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'asignarPermiso'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revocarPermiso'])->name('roles.permissions.revoke');
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'asignarRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'revocarRole'])->name('permissions.roles.remove');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users-create', CreateUser::class)->name('user.create');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');
    //User-Role
    Route::post('/users/{user}/roles', [UserController::class, 'asignarRole'])->name('user.roles');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'revocarRole'])->name('user.roles.remove');

    //User-Permission
    Route::post('/user/{user}/permissions', [UserController::class, 'AsignarPermiso'])->name('user.permission');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revocarPermiso'])->name('user.permission.remove');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';