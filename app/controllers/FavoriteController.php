<?php

namespace App\Controllers;

use App\Models\Favorite;
use App\Services\TmdbService;
use Core\Session;

class FavoriteController extends Controller
{
    private TmdbService $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index()
    {
        $userId = $_SESSION['user'];

        $favorites = Favorite::where(
            'user_id',
            '=',
            $userId
        )->get();

        $movies = [];

        foreach ($favorites as $favorite) {

            $movie = $this->tmdb->getMovie((int) $favorite->movie_id);

            if (!empty($movie)) {
                $movies[] = $movie;
            }
        }

        return $this->view('favorites/index', [
            'movies' => $movies
        ]);
    }

    public function store($movieId)
    {
        $userId = $_SESSION['user'];

        if (Favorite::isFavorite($userId, $movieId)) {

            Session::flash(
                'error',
                'This movie is already in your favorites.'
            );

            return redirect("/movies/{$movieId}");
        }

        $favorite = new Favorite([
            'user_id' => $userId,
            'movie_id' => $movieId
        ]);

        $favorite->save();

        Session::flash(
            'success',
            'Movie added to favorites! ❤️'
        );

        return redirect("/movies/{$movieId}");
    }

    public function destroy($movieId)
    {
        $userId = $_SESSION['user'];

        $favorite = Favorite::findByUserAndMovie(
            $userId,
            $movieId
        );

        if (!$favorite) {

            Session::flash(
                'error',
                'Movie is not in your favorites.'
            );

            return redirect("/movies/{$movieId}");
        }

        $favoriteModel = new Favorite([
            'id' => $favorite->id
        ]);

        $favoriteModel->delete();

        Session::flash(
            'success',
            'Movie removed from favorites.'
        );

        return redirect("/movies/{$movieId}");
    }
}