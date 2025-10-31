<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LimitsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'showForm'])->name('user.form');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/get-users-list-in-mony-project-in-json-format', [UserController::class, 'getUsersListInJsonFormat'])->name('user.getUsersListInJsonFormat');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');

Route::get('/deposits', [DepositController::class, 'index'])->name('deposits.index');
Route::get('/deposits/create', [DepositController::class, 'create'])->name('deposits.create');
Route::post('/deposits', [DepositController::class, 'store'])->name('deposits.store');

Route::get('/limits', [LimitsController::class, 'index'])->name('limits.index');
Route::put('/limits', [LimitsController::class, 'update'])->name('limits.update');
