<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

Route::apiResource('users', UserController::class);
Route::apiResource('transactions', TransactionController::class);
