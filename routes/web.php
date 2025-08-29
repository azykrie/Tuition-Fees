<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClassRoomsController;
use App\Http\Controllers\Admin\TuitionFeesController;
use App\Http\Controllers\Students\PaymentsController as StudentPaymentsController;
use App\Http\Controllers\Students\DashboardController as StudentDashboardController;

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
    Route::resource('/class-rooms', ClassRoomsController::class);
    Route::resource('/tuition-fees', TuitionFeesController::class);
    Route::resource('/payments', PaymentsController::class);

});

Route::prefix('student')->name('student.')->group(function () {
    Route::resource('/dashboard', StudentDashboardController::class);
    Route::resource('/my-tuition-fees', StudentPaymentsController::class);
    Route::get('/payments/{payment}/pay', [StudentPaymentsController::class, 'pay'])->name('payments.pay');
    
});