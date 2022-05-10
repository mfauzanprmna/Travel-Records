<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CatperController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::get('register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'sendLink'])->name('sendLink');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');
Route::post('/filter', [AuthController::class, 'filter'])->name('filter');
Route::get('delete/{id}', [CatperController::class, 'delete'])->name('delete');
Route::get('delete/akun/{id}', [UserController::class, 'delete'])->name('delete.akun');
Route::get('/catper/export', [CatperController::class, 'export'])->name('catper.export');
Route::get('/catper/pdf', [CatperController::class, 'pdf'])->name('catper.pdf');
Route::resource('catper', CatperController::class);
Route::resource('akun', UserController::class);
Route::put('akun/nik/{akun}', [UserController::class, 'editNIK'])->name('edit.nik');