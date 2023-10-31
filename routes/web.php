<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('api')->group(function () {
    /*customers routes START*/
    Route::get('customers', [CustomerController::class, 'index']);
    Route::get('customers/{id}', [CustomerController::class, 'show']);
    Route::get('customers/{id}/edit', [CustomerController::class, 'edit']);
    Route::post('customers', [CustomerController::class, 'store']);
    Route::put('customers/{customer}', [CustomerController::class, 'update']);
    Route::delete('customers/{id}', [CustomerController::class, 'destroy']);
    /*customers routes END*/


    /*Invoices routes START*/
    Route::get('invoices', [InvoiceController::class, 'index']);
    Route::get('invoices/{invoice}', [InvoiceController::class, 'show']);
    Route::get('invoices/{invoice}/edit', [InvoiceController::class, 'edit']);
    Route::post('invoices', [InvoiceController::class, 'store']);
    Route::put('invoices/{invoice}', [InvoiceController::class, 'update']);
    Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy']);
    /*Invoices routes END*/

    
    /*User routes START*/
    Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware('auth');
    Route::put('/user-profile/update', [UserController::class, 'update'])->middleware('auth');
    /*User routes END*/

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});


Auth::routes();

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('generate-pdf');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');