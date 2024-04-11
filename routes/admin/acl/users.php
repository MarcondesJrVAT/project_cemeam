<?php

use App\Http\Controllers\Admin\Acl\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('usuarios')->name('admin.users.')->group(function ()
{
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/novo-usuario', [UserController::class, 'create'])->name('create');
    Route::post('/novo-usuario', [UserController::class, 'store'])->name('store');
    Route::get('/visualizar-usuario/{id}', [UserController::class, 'show'])->name('show');
    Route::get('/editar-usuario/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('/editar-usuario/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/excluir-usuario/{id}', [UserController::class, 'destroy'])->name('destroy');
});
