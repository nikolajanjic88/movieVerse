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
        $query = trim($_GET['query'] ?? '');
       
        $page = isset($_GET['page'])
            ? (int) $_GET['page']
            : 1;

        if ($page < 1) {
            $page = 1;
        }

        $response = [];

        if ($query !== '') {
            $response = $this->tmdb->searchMovies(
                $query,
                $page
            );
        }

        return $this->view('movies/index', [
            'movies' => $response['results'] ?? [],
            'query' => $query,
            'currentPage' => $response['page'] ?? $page,
            'totalPages' => $response['total_pages'] ?? 1
        ]);
    }


    public function show($id)
    {
        $movie = $this->tmdb->getMovie((int) $id);

        $similarResponse = $this->tmdb->getSimilarMovies((int) $id);

        $similarMovies = array_slice(
            $similarResponse['results'] ?? [],
            0,
            6
        );

        $credits = $this->tmdb->getMovieCredits((int) $id);

        $cast = array_slice($credits['cast'] ?? [], 0, 10);

        $director = null;

        foreach ($credits['crew'] ?? [] as $crewMember) {
            if ($crewMember['job'] === 'Director') {
                $director = $crewMember;
                break;
            }
        }

        $videos = $this->tmdb->getMovieVideos((int) $id);

        $trailer = null;

        foreach ($videos['results'] ?? [] as $video) {
            if (
                $video['site'] === 'YouTube' &&
                $video['type'] === 'Trailer' &&
                $video['official'] === true
            ) {
                $trailer = $video;
                break;
            }
        }

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
            'cast' => $cast,
            'director' => $director,
            'trailer' => $trailer,
            'similarMovies' => $similarMovies,
            'isFavorite' => $isFavorite,
            'isWatchlisted' => $isWatchlisted,
            'userRating' => $userRating,
            'averageRating' => $averageRating,
            'userReview' => $userReview,
            'reviews' => $reviews
        ]);
    }
}