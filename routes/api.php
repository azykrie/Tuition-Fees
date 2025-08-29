<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\PaymentsController as StudentPaymentsController;


Route::post('/midtrans/callback', [StudentPaymentsController::class, 'callback']);
