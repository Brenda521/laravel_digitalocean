<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodController;


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
    return view('Auth.login');
});
Route::get('login',[AuthController::class,'login'])->name('login');
Route::get('register',[AuthController::class,'register'])->name('register');
Route::post('ingresar',[AuthController::class,'ingresar'])->name('ingresar');
Route::post('registracion',[AuthController::class,'registracion'])->name('registracion');

Route::middleware('codeveri')->group(function () {
    Route::get('home',[AuthController::class,'home'])->name('home');
    Route::get('cerrarSesion',[AuthController::class,'cerrarSesion'])->name('cerrarSesion');
});


Route::middleware('auth')->group(function () {
    Route::get('conf_cod',[CodController::class,'codigos'])->name('codigos');
    Route::post('valCod',[CodController::class,'valCod'])->name('valCod');
});
