<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/users', UsersController::class);
    Route::get('/export/csv', [UsersController::class, 'exportCsv'])->name('export.csv');
    Route::get('/export/sql', [UsersController::class, 'exportSql'])->name('export.sql');

});