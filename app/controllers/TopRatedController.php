<?php

namespace App\Controllers;

use App\Services\TmdbService;

class TopRatedController extends Controller
{
    private TmdbService $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index()
    {
        $page = isset($_GET['page'])
            ? (int) $_GET['page']
            : 1;

        if ($page < 1) {
            $page = 1;
        }

        $response = $this->tmdb->getTopRatedMovies($page);

        return $this->view('top-rated/index', [
            'movies' => $response['results'] ?? [],
            'currentPage' => $response['page'] ?? $page,
            'totalPages' => $response['total_pages'] ?? 1
        ]);
    }


}
