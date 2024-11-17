<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;



Route::get('/', function () {
    return view('welcome');
});

// User Login
Route::get('/', [UserLoginController::class, 'loginForm'])->name('login');
Route::post('/', [UserLoginController::class, 'login']);
Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');

// Display the registration form
Route::get('/register', [UserLoginController::class, 'registerForm'])->name('registerForm');

// Handle registration form submission
Route::post('/register', [UserLoginController::class, 'register'])->name('register');

Route::get('/test-auth', function () {
    return auth()->user() ? auth()->user() : 'Not authenticated';
})->middleware('auth');

// Invoice
Route::get('transactions/{id}/invoice', [TransactionController::class, 'generateInvoice'])->name('transactions.invoice');
Route::get('transactions/{id}/ticket', [TransactionController::class, 'generateTickets'])->name('transactions.ticket');

Route::view('/abouts', 'abouts.about'); 





Route::middleware( ['auth']   )->group(function () {
    Route::get('/abouts', 
        function(){
            return view('abouts.about');
        }
    )->name('abouts');
    // Products
    Route::resource('products', ProductController::class); 
    Route::resource('users', UserLoginController::class); 
    // Transactions
    Route::resource('transactions', TransactionController::class);
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});
