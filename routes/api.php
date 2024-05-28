<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//Rutas de autencacion con google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

//Register
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify')->middleware('signed');

//Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:api');