<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;


    Route::resource('users', UserController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('invoices', InvoiceController::class);

