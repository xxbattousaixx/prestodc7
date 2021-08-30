<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;


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

Route::get('/', [PublicController::class, 'index']);

// CRUD ANNUNCI
Route::resource('articles', ArticleController::class);

// CATEGORIE
Route::get('/category/{name}/{id}/articles', [PublicController::class, 'articlesByCategory'])->name('public.articles.category');

//Revisor
Route::get('/revisor/home', [RevisorController::class, 'index'])->name('revisor.home');
Route::post('/revisor/article/{id}/accept', [RevisorController::class, 'accept'])->name('revisor.accept');
Route::post('/revisor/article/{id}/reject', [RevisorController::class, 'reject'])->name('revisor.reject');
Route::get('/revisor/rejected', [RevisorController::class, 'indexRejected'])->name('revisor.rejected');

//SEARCH
Route::get('/search', [PublicController::class, 'search'])->name('search.results');

//LOCALE
Route::post('/locale/{locale}', [PublicController::class, 'locale'])->name('locale');

//Imagini
Route::post('/article/images/upload', [ArticleController::class, 'uploadImage'])->name('article.images.upload');
