<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('user', function () {
    return response()->json([
        'user' => auth()->user(),
    ]);
})->middleware('auth:api');

Route::middleware('auth:api')->prefix('expense')->group(function () {
    Route::get('/users', [ExpenseController::class, 'getAllUserWithExpenses']);
    Route::get('/', [ExpenseController::class, 'index']);
    Route::post('/', [ExpenseController::class, 'store']);
    Route::get('/{task}', [ExpenseController::class, 'show']);
    Route::patch('/{task}', [ExpenseController::class, 'update']);
    Route::delete('/{task}', [ExpenseController::class, 'destroy']);
});
