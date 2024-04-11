<?php

use App\Http\Controllers\Admin\Lms\CategoryController;
use App\Http\Controllers\Admin\Lms\CourseController;
use App\Http\Controllers\Admin\Lms\GradeController;
use App\Http\Controllers\Admin\Lms\LessonController;
use App\Http\Controllers\Admin\Lms\SubjectController;
use App\Http\Controllers\Admin\Lms\YearController;
use Illuminate\Support\Facades\Route;

Route::prefix('lms')->name('admin.lms.')->group(function ()
{
    Route::prefix('anos-letivos')->name('years.')->group(function ()
    {
        Route::get('/', [YearController::class, 'index'])->name('index');
        Route::get('/novo-ano', [YearController::class, 'create'])->name('create');
        Route::post('/novo-ano', [YearController::class, 'store'])->name('store');
        Route::get('/visualizar-ano/{id}', [YearController::class, 'show'])->name('show');
        Route::get('/editar-ano/{id}', [YearController::class, 'edit'])->name('edit');
        Route::put('/editar-ano/{id}', [YearController::class, 'update'])->name('update');
        Route::delete('/excluir-ano/{id}', [YearController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('categorias')->name('categories.')->group(function ()
    {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/nova-categoria', [CategoryController::class, 'create'])->name('create');
        Route::post('/nova-categoria', [CategoryController::class, 'store'])->name('store');
        Route::get('/visualizar-categoria/{id}', [CategoryController::class, 'show'])->name('show');
        Route::get('/editar-categoria/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/editar-categoria/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/excluir-categoria/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('cursos')->name('courses.')->group(function ()
    {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/novo-curso', [CourseController::class, 'create'])->name('create');
        Route::post('/novo-curso', [CourseController::class, 'store'])->name('store');
        Route::get('/visualizar-curso/{id}', [CourseController::class, 'show'])->name('show');
        Route::get('/editar-curso/{id}', [CourseController::class, 'edit'])->name('edit');
        Route::put('/editar-curso/{id}', [CourseController::class, 'update'])->name('update');
        Route::delete('/excluir-curso/{id}', [CourseController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('componentes')->name('subjects.')->group(function ()
    {
        Route::get('/', [SubjectController::class, 'index'])->name('index');
        Route::get('/novo-componente', [SubjectController::class, 'create'])->name('create');
        Route::post('/novo-componente', [SubjectController::class, 'store'])->name('store');
        Route::get('/visualizar-componente/{id}', [SubjectController::class, 'show'])->name('show');
        Route::get('/editar-componente/{id}', [SubjectController::class, 'edit'])->name('edit');
        Route::put('/editar-componente/{id}', [SubjectController::class, 'update'])->name('update');
        Route::delete('/excluir-componente/{id}', [SubjectController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('series')->name('grades.')->group(function ()
    {
        Route::get('/', [GradeController::class, 'index'])->name('index');
        Route::get('/nova-serie', [GradeController::class, 'create'])->name('create');
        Route::post('/nova-serie', [GradeController::class, 'store'])->name('store');
        Route::get('/visualizar-serie/{id}', [GradeController::class, 'show'])->name('show');
        Route::get('/editar-serie/{id}', [GradeController::class, 'edit'])->name('edit');
        Route::put('/editar-serie/{id}', [GradeController::class, 'update'])->name('update');
        Route::delete('/excluir-serie/{id}', [GradeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('aulas')->name('lessons.')->group(function ()
    {
        Route::get('/', [LessonController::class, 'index'])->name('index');
        Route::get('/nova-aula', [LessonController::class, 'create'])->name('create');
        Route::post('/nova-aula', [LessonController::class, 'store'])->name('store');
        Route::get('/visualizar-aula/{id}', [LessonController::class, 'show'])->name('show');
        Route::get('/editar-aula/{id}', [LessonController::class, 'edit'])->name('edit');
        Route::put('/editar-aula/{id}', [LessonController::class, 'update'])->name('update');
        Route::delete('/excluir-aula/{id}', [LessonController::class, 'destroy'])->name('destroy');
    });
});
