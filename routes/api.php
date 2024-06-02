<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\TasaEquivalenciaController;
use App\Http\Controllers\VerdCoinsController;
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
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register')->middleware('guest');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify')->middleware('signed');

//Login
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');
 
//Recuperar contraseña
Route::post('/auth/password/reset', [AuthController::class, 'sendResetLinkEmail'])->name('auth.password.reset'); 
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/auth/password/reset/process', [AuthController::class, 'resetPassword'])->name('auth.password.reset.process');


//Logout
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth:api');
//Gestion de catalagos
Route::middleware('auth:api')->group(function () {
    Route::resource('verdcoins', VerdCoinsController::class)->parameters(['verdcoins' => 'verdcoins'])->names('verdcoins');
    Route::resource('categorias', CategoriasController::class)->parameters(['categorias' => 'categorias'])->names('categorias');
    Route::resource('productos', ProductosController::class)->parameters(['productos' => 'productos'])->names('productos');
    Route::resource('tasa_equivalencia', TasaEquivalenciaController::class)->parameters(['tasa_equivalencia' => 'tasa_equivalencia'])->names('tasa_equivalencia');

});