<?php

use App\Http\Controllers\Admin\Acl\PermissionController;
use Illuminate\Support\Facades\Route;

Route::prefix('permissoes')->name('admin.permissions.')->group(function ()
{
    Route::get('/', [PermissionController::class, 'index'])->name('index');
    Route::get('/nova-permissao', [PermissionController::class, 'create'])->name('create');
    Route::post('/nova-permissao', [PermissionController::class, 'store'])->name('store');
    Route::get('/visualizar-permissao/{id}', [PermissionController::class, 'show'])->name('show');
    Route::get('/editar-permissao/{id}', [PermissionController::class, 'edit'])->name('edit');
    Route::put('/editar-permissao/{id}', [PermissionController::class, 'update'])->name('update');
    Route::delete('/excluir-permissao/{id}', [PermissionController::class, 'destroy'])->name('destroy');
});
