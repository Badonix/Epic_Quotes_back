<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
Route::middleware('auth:sanctum')->get('/me', [UserController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class , 'authenticate']);
Route::post('/forgot-password', [PasswordResetController::class, 'send']);
Route::get('/reset-password/{token}', [PasswordResetController::class, 'index'])->name('password.reset');
Route::get('/auth/redirect', [GoogleAuthController::class, 'redirect']);
Route::post('/auth/callback', [GoogleAuthController::class, 'callback']);

Route::post('/reset-password', [PasswordResetController::class, 'reset'])->middleware('guest')->name('password.update');

Route::post('/movies', [MovieController::class, 'store']);
Route::get('/movies', [MovieController::class, 'view']);
Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);
Route::post('/movies/{movie}/edit', [MovieController::class, 'edit']);
Route::get('/movies/{movie}', [MovieController::class, 'index']);