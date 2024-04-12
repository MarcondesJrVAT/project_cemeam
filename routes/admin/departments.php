<?php

use App\Http\Controllers\Admin\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('departamentos')->name('admin.departments.')->group(function ()
{
    Route::get('/', [DepartmentController::class, 'index'])->name('index');
    Route::get('/novo-departamento', [DepartmentController::class, 'create'])->name('create');
    Route::post('/novo-departamento', [DepartmentController::class, 'store'])->name('store');
    Route::get('/visualizar-departamento/{id}', [DepartmentController::class, 'show'])->name('show');
    Route::get('/editar-departamento/{id}', [DepartmentController::class, 'edit'])->name('edit');
    Route::put('/editar-departamento/{id}', [DepartmentController::class, 'update'])->name('update');
    Route::delete('/excluir-departamento/{id}', [DepartmentController::class, 'destroy'])->name('destroy');
});
