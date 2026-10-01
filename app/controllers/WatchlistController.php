<?php

namespace App\Controllers;

use App\Models\Watchlist;
use App\Services\TmdbService;
use Core\Session;

class WatchlistController extends Controller
{
    private TmdbService $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function store($movieId)
    {
        $userId = $_SESSION['user'];

        if (Watchlist::isInWatchlist($userId, $movieId)) {

            Session::flash(
                'error',
                'This movie is already in your watchlist.'
            );

            return redirect("/movies/{$movieId}");
        }

        $watchlist = new Watchlist([
            'user_id' => $userId,
            'movie_id' => $movieId
        ]);

        $watchlist->save();

        Session::flash(
            'success',
            'Movie added to watchlist! 📋'
        );

        return redirect("/movies/{$movieId}");
    }

    public function index()
    {
        $userId = $_SESSION['user'];

        $watchlist = Watchlist::where(
            'user_id',
            '=',
            $userId
        )->get();

        $movies = [];

        foreach ($watchlist as $item) {

            $movie = $this->tmdb->getMovie(
                (int) $item->movie_id
            );

            if (!empty($movie)) {
                $movies[] = $movie;
            }
        }

        return $this->view('watchlist/index', [
            'movies' => $movies
        ]);
    }

    public function destroy($movieId)
    {
        $userId = $_SESSION['user'];

        $watchlist = Watchlist::findByUserAndMovie(
            $userId,
            $movieId
        );

        if (!$watchlist) {

            Session::flash(
                'error',
                'Movie is not in your watchlist.'
            );

            return redirect("/movies/{$movieId}");
        }

        $watchlistModel = new Watchlist([
            'id' => $watchlist->id
        ]);

        $watchlistModel->delete();

        Session::flash(
            'success',
            'Movie removed from watchlist.'
        );

        return redirect("/movies/{$movieId}");
    }
}