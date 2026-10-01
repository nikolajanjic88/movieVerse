<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Favorite;
use App\Models\Watchlist;
use App\Models\Rating;
use App\Models\Review;
use App\Services\TmdbService;

class ProfileController extends Controller
{
    private TmdbService $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index()
    {
        $userId = $_SESSION['user'];

        $user = User::find($userId);

        $favorites = Favorite::where(
            'user_id',
            '=',
            $userId
        )->get();

        $watchlist = Watchlist::where(
            'user_id',
            '=',
            $userId
        )->get();

        $ratings = Rating::where(
            'user_id',
            '=',
            $userId
        )->get();

        $reviews = Review::where(
            'user_id',
            '=',
            $userId
        )->get();

        return $this->view('profile/index', [
            'user' => $user,
            'favoritesCount' => count($favorites),
            'watchlistCount' => count($watchlist),
            'ratingsCount' => count($ratings),
            'reviewsCount' => count($reviews)
        ]);
    }

    public function ratings()
    {
        $userId = $_SESSION['user'];

        $ratings = Rating::where(
            'user_id',
            '=',
            $userId
        )->get();

        $movies = [];

        foreach ($ratings as $rating) {

            $movie = $this->tmdb->getMovie(
                (int) $rating->movie_id
            );

            if (!empty($movie)) {
                $movie['user_rating'] = $rating->rating;

                $movies[] = $movie;
            }
        }

        return $this->view('profile/ratings', [
            'movies' => $movies
        ]);
    }

    public function reviews()
    {
        $userId = $_SESSION['user'];

        $reviews = Review::where(
            'user_id',
            '=',
            $userId
        )->get();

        $movies = [];

        foreach ($reviews as $review) {

            $movie = $this->tmdb->getMovie(
                (int) $review->movie_id
            );

            if (!empty($movie)) {
                $movie['review_content'] = $review->content;
                $movie['review_created_at'] = $review->created_at;

                $movies[] = $movie;
            }
        }

        return $this->view('profile/reviews', [
            'movies' => $movies
        ]);
    }
}