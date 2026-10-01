<?php

namespace App\Controllers;

use App\Services\TmdbService;

class GenreController extends Controller
{
    private TmdbService $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }


    public function index()
    {
        $genresResponse = $this->tmdb->getGenres();

        $genres = $genresResponse['genres'] ?? [];

        foreach ($genres as &$genre) {
            $moviesResponse = $this->tmdb->discoverMoviesByGenre(
                (int) $genre['id']
            );

            $movies = $moviesResponse['results'] ?? [];

            $genre['backdrop'] = null;

            foreach ($movies as $movie) {
                if (!empty($movie['backdrop_path'])) {
                    $genre['backdrop'] = $movie['backdrop_path'];
                    break;
                }
            }
        }

        return $this->view('genres/index', [
            'genres' => $genres
        ]);
    }


    public function show($id)
    {
        $genres = $this->tmdb->getGenres();

        $genre = null;

        foreach ($genres['genres'] ?? [] as $item) {
            if ((int) $item['id'] === (int) $id) {
                $genre = $item;
                break;
            }
        }

        if (!$genre) {
            abort();
        }

        $movies = $this->tmdb->discoverMoviesByGenre((int) $id);

        return $this->view('genres/show', [
            'genre' => $genre,
            'movies' => $movies['results'] ?? []
        ]);
    }
}