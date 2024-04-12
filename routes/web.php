<?php

use App\Http\Controllers\Admin\PrincipalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('site.dashboard');
})->name('site.dashboard');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function ()
{
    Route::get('/inicio', [PrincipalController::class, 'index'])->name('admin.dashboard');

    require __DIR__ . '/admin/acl/permissions.php';
    require __DIR__ . '/admin/acl/roles.php';
    require __DIR__ . '/admin/acl/users.php';
    require __DIR__ . '/admin/lms.php';
    require __DIR__ . '/admin/departments.php';
});
