<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VoteController;
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

Route::get('/', [LoginController::class, 'index']);

// Route authentication
// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::post('/register', [RegisterController::class, 'store'])->middleware('admin');

// Route menu dashboard
Route::get('/dashboard/home', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard/vote', [DashboardController::class, 'vote'])->middleware('voter');
Route::get('/dashboard/signup', [DashboardController::class, 'register'])->middleware('admin');
Route::get('/dashboard/result', [DashboardController::class, 'result'])->middleware('admin');

// Route voting
Route::post('/voting', [VoteController::class, 'store'])->middleware('yetToVote');
