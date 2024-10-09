<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PagesController::class,'index'])->name('index');

Route::get('/home', [HomeController::class,'index'] )->name('home')->middleware('auth');

Auth::routes();

