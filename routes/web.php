<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;


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
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');

Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');

Route::get('/show/{post}', [App\Http\Controllers\HomeController::class, 'show'])->name('show');

//Users.Show
Route::get('/users/show', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');

//comment.create
Route::get('/comment/create', [App\Http\Controllers\CommentController::class, 'create'])->name('comment.create');

Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');

Route::get('/posts/search', [App\Http\Controllers\HomeController::class, 'search'])->name('posts.search');

Route::post('posts/{post}/favorites', [App\Http\Controllers\FavoriteController::class, 'store'])->name('favorites');
Route::post('posts/{post}/unfavorites', [App\Http\Controllers\FavoriteController::class, 'destroy'])->name('unfavorites');

Route::post('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
