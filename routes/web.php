<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('login/google', [LoginController::class,'googleLogin'])->name('login.google');
Route::get('register/google/', [LoginController::class,'googleSignUp'])->name('register.google');
Route::get('login/google/callback', [LoginController::class,'googleLoginHandler']);
Route::get('register/google/callback', [LoginController::class,'googleSignUpHandler']);

