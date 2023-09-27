<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/post',[PostController::class,'index'])->name('post_show');
// Route::post('/post-store',[PostController::class,'store'])->name('post_store');
// Route::post('/post-commit',[PostController::class,'post_commit'])->name('post_commit');
// Route::get('/commit/{id}',[PostController::class,'get_commit'])->name('get_commit');

Route::get('/task',[TaskController::class,'index'])->name('task.data');

Route::post('/task-create',[TaskController::class,'create'])->name('task.create');
Route::post('/task-delete/{id}',[TaskController::class,'destory'])->name('task.destory');

