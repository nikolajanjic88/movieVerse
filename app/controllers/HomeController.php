<?php

namespace App\Controllers;

use App\Services\TmdbService;

class HomeController extends Controller
{
    private TmdbService $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function home()
    {
        $trending = $this->tmdb->getTrendingMovies('week');
        $genres = $this->tmdb->getGenres();

        return $this->view('home', [
            'trending' => $trending['results'] ?? [],
            'genres' => $genres['genres'] ?? []
        ]);
    }
}