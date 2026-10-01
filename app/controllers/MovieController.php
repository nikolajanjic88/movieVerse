<?php

namespace App\Controllers;

use App\Models\Favorite;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Watchlist;
use App\Services\TmdbService;

class MovieController extends Controller
{
    private TmdbService $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index()
    {
        $movies = [];

        if (!empty($_GET['query'])) {
            $movies = $this->tmdb->searchMovies($_GET['query']);
        }

        return $this->view('movies/index', [
            'movies' => $movies
        ]);
    }

    public function show($id)
    {
        $movie = $this->tmdb->getMovie((int) $id);

        $isFavorite = false;
        $isWatchlisted = false;
        $userRating = null;
        $userReview = null;

        if (!empty($_SESSION['user'])) {

            $userId = $_SESSION['user'];

            $isFavorite = Favorite::isFavorite(
                $userId,
                $id
            );

            $isWatchlisted = Watchlist::isInWatchlist(
                $userId,
                $id
            );

            $userRating = Rating::getUserRating(
                $userId,
                $id
            );

            $userReview = Review::getUserReview(
                $userId,
                $id
            );
        }

        $averageRating = Rating::getAverageRating($id);

        $reviews = Review::getByMovie($id);

        return $this->view('movies/show', [
            'movie' => $movie,
            'isFavorite' => $isFavorite,
            'isWatchlisted' => $isWatchlisted,
            'userRating' => $userRating,
            'averageRating' => $averageRating,
            'userReview' => $userReview,
            'reviews' => $reviews
        ]);
    }
}