<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
Route::get('/friends', [FriendController::class, 'index'])->name('friends');
Route::post('/friends/{friend}/lend-money', [FriendController::class, 'lendMoneyToFriend'])->name('lend_money');
Route::post('/friends/{friend}/receive-repayment', [FriendController::class, 'receiveRepaymentFromFriend'])->name('receive_repayment');

Route::get('/friend/{friend}/transactions/details', [TransactionController::class, 'showFriendTransactions']);
Route::post('/sell-transaction', [TransactionController::class, 'sellTransaction'])->name('sell.transaction');
Route::get('/customer/{customer}/transactions/details', [TransactionController::class, 'showCustomerTransactions']);
Route::post('/supplier-transaction', [TransactionController::class, 'supplierTransaction'])->name('supplier.transaction');
Route::get('/supplier/{supplier}/transactions/details', [TransactionController::class, 'showSupplierTransactions']);

Route::get('/report', [ReportController::class, 'reportGenerate'])->name('report');