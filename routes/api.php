<?php

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('articles/{article}', [ArticleController::class, 'show']);
