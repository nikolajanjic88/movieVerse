<?php

use App\Controllers\FavoriteController;
use App\Controllers\GenreController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\ProfileController;
use App\Controllers\RatingController;
use App\Controllers\RegisterController;
use App\Controllers\ReviewController;
use App\Controllers\TopRatedController;
use App\Controllers\WatchlistController;
use Core\Router;

Router::get('/', [HomeController::class, 'home']);
Router::get('/login', [LoginController::class, 'loginForm'])->middleware('guest');
Router::post('/login', [LoginController::class, 'login'])->middleware('guest');
Router::delete('/logout', [LoginController::class, 'logout'])->middleware('auth');
Router::get('/register', [RegisterController::class, 'registerForm'])->middleware('guest');
Router::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Router::get('/movies', [MovieController::class, 'index']);
Router::get('/movies/{id}', [MovieController::class, 'show']);
Router::post('/favorites/{movieId}', [FavoriteController::class, 'store'])->middleware('auth');
Router::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth');
Router::delete('/favorites/{movieId}', [FavoriteController::class, 'destroy'])->middleware('auth');
Router::post('/watchlist/{movieId}', [WatchlistController::class, 'store'])->middleware('auth');
Router::delete('/watchlist/{movieId}', [WatchlistController::class, 'destroy'])->middleware('auth');
Router::get('/watchlist', [WatchlistController::class, 'index'])->middleware('auth');
Router::post('/ratings/{movieId}', [RatingController::class, 'store'])->middleware('auth');
Router::post('/reviews/{movieId}', [ReviewController::class, 'store'])->middleware('auth');
Router::delete('/reviews/{reviewId}', [ReviewController::class, 'destroy'])->middleware('auth');
Router::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
Router::get('/profile/ratings', [ProfileController::class, 'ratings'])->middleware('auth');
Router::get('/profile/reviews', [ProfileController::class, 'reviews'])->middleware('auth');
Router::get('/genres', [GenreController::class, 'index']);
Router::get('/genres/{id}', [GenreController::class, 'show']);
Router::get('/top-rated', [TopRatedController::class, 'index']);