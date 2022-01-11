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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});


Auth::routes();

Route::get('/home', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\HomeController@index']);
Route::get('/api/orders', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\OrderController@index']);

Route::post('/api/orders', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\OrderController@store']);
