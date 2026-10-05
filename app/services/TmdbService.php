<?php

namespace App\Services;

class TmdbService
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = TMDB_BASE_URL;
        $this->apiKey = TMDB_API_KEY;
    }

    public function searchMovies(string $query,int $page = 1): array 
    {
        $url = $this->baseUrl . '/search/movie?' . http_build_query([
            'api_key' => $this->apiKey,
            'query' => $query,
            'language' => 'en-US',
            'page' => $page,
        ]);

        $response = file_get_contents($url);

        return json_decode($response, true);
    }


    public function getMovie(int $movieId): array
    {
        $url = $this->baseUrl . "/movie/{$movieId}?" . http_build_query([
            'api_key' => $this->apiKey,
            'language' => 'en-US',
        ]);

        $response = file_get_contents($url);

        return json_decode($response, true);
    }

    public function getTrendingMovies(string $timeWindow = 'week'): array
    {
        $url = $this->baseUrl . "/trending/movie/{$timeWindow}?" . http_build_query([
            'api_key' => $this->apiKey,
            'language' => 'en-US',
        ]);

        $response = file_get_contents($url);

        return json_decode($response, true);
    }

    public function getGenres(): array
    {
        $url = $this->baseUrl . '/genre/movie/list?' . http_build_query([
            'api_key' => $this->apiKey,
            'language' => 'en-US',
        ]);

        $response = file_get_contents($url);

        return json_decode($response, true);
    }

    public function discoverMoviesByGenre(int $genreId): array
    {
        $url = $this->baseUrl . '/discover/movie?' . http_build_query([
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'with_genres' => $genreId,
            'sort_by' => 'popularity.desc',
        ]);

        $response = file_get_contents($url);

        return json_decode($response, true);
    }


    public function getTopRatedMovies(int $page = 1): array
    {
        $url = $this->baseUrl . '/movie/top_rated?' . http_build_query([
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'page' => $page,
        ]);

        $response = file_get_contents($url);

        return json_decode($response, true);
    }

    public function getMovieCredits(int $movieId): array
    {
        $url = $this->baseUrl . "/movie/{$movieId}/credits?" . http_build_query([
            'api_key' => $this->apiKey,
            'language' => 'en-US',
        ]);

        $response = file_get_contents($url);

        return json_decode($response, true);
    }

    
    public function getMovieVideos(int $movieId): array
    {
        $url = $this->baseUrl . "/movie/{$movieId}/videos?" . http_build_query([
            'api_key' => $this->apiKey,
            'language' => 'en-US',
        ]);

        $response = file_get_contents($url);

        return json_decode($response, true);
    }


}