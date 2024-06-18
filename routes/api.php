<?php

use App\Http\Controllers\Api\ArticleController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('articles/{article}', [ArticleController::class, 'show'])->name('api.articles.show');

Route::get('articles', [ArticleController::class, 'index'])->name('api.articles.index');

Route::post('articles', [ArticleController::class, 'store'])->name('api.articles.store');
