<?php

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
Route::get('/test', function () {
    return view('test');
});

Route::get('/swagger-ui', function () {
    return view('swagger');
})->middleware('basic-auth');

Route::get('/login', function () {
    return view('login');
})->name('admin.login-form');

Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login');
Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
