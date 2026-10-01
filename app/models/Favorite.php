<?php

namespace App\Models;

use Core\Model;

class Favorite extends Model
{
    protected static $table = 'favorites';


    public static function isFavorite($userId, $movieId)
    {
        return static::where(
            'user_id',
            '=',
            $userId
        )->where(
            'movie_id',
            '=',
            $movieId
        )->first() !== null;
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