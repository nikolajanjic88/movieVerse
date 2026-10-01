<?php

namespace App\Models;

use Core\Model;

class Watchlist extends Model
{
    protected static $table = 'watchlist';

    public static function isInWatchlist($userId, $movieId)
    {
        return static::findByUserAndMovie(
            $userId,
            $movieId
        ) !== null;
    }

    public static function findByUserAndMovie($userId, $movieId)
    {
        return static::where(
            'user_id',
            '=',
            $userId
        )->where(
            'movie_id',
            '=',
            $movieId
        )->first();
    }
}