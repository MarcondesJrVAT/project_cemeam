<?php

use App\Http\Controllers\Admin\Acl\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('funcoes')->name('admin.roles.')->group(function ()
{
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/nova-funcao', [RoleController::class, 'create'])->name('create');
    Route::post('/nova-funcao', [RoleController::class, 'store'])->name('store');
    Route::get('/visualizar-funcao/{id}', [RoleController::class, 'show'])->name('show');
    Route::get('/editar-funcao/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::put('/editar-funcao/{id}', [RoleController::class, 'update'])->name('update');
    Route::delete('/excluir-funcao/{id}', [RoleController::class, 'destroy'])->name('destroy');
});
