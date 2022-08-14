<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/' , [Controller::class , 'index'])->name('home');
Route::get('/allItem' , [Controller::class , 'allItem'])->name('showAllItem');
// Route::get('v1/get/latest/price/{symbol}' , [Controller::class , 'latestPrice']);
