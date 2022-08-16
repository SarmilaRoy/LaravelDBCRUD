<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/',[PostController::class,'showData'])->name('home');
Route::get('/add-data',[PostController::class,'addData']);
//add data
Route::post('/store-data',[PostController::class,'storeData']);
//Edit data display
Route::get('/edit-data/{id}',[PostController::class,'editData']);
//edit data
Route::post('/updatedata/{id}',[PostController::class,'updateData']);
//delete
Route::get('/delete-data/{id}',[PostController::class,'deleteData']);

