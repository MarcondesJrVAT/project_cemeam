<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PrincipalController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('site.dashboard');
})->name('site.dashboard');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function ()
{
    Route::get('/inicio', [PrincipalController::class, 'index'])->name('admin.dashboard');

    Route::get('/permissoes', [PermissionController::class, 'index'])->name('admin.permissions');

    Route::get('/funcoes', [RoleController::class, 'index'])->name('admin.roles');

    Route::get('/usuarios', [UserController::class, 'index'])->name('admin.users');
});
