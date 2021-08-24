<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;

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

Route::get('/', [PublicController::class,'index']);

// CRUD ANNUNCI
Route::resource('articles', ArticleController::class);

// CATEGORIE
Route::get('/category/{name}/{id}/articles', [PublicController::class, 'articlesByCategory'])->name('public.articles.category');