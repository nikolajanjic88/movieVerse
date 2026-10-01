<?php

namespace App\Models;

use Core\Model;

class Rating extends Model
{
    protected static $table = 'ratings';

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

    public static function getUserRating($userId, $movieId)
    {
        $rating = static::findByUserAndMovie(
            $userId,
            $movieId
        );

        return $rating ? $rating->rating : null;
    }

    public static function getAverageRating($movieId)
    {
        $connection = static::getConnection();

        $stmt = $connection->prepare(
            "SELECT AVG(rating) AS average_rating
             FROM " . static::$table . "
             WHERE movie_id = :movie_id"
        );

        $stmt->execute([
            'movie_id' => $movieId
        ]);

        $result = $stmt->fetch();

        return $result->average_rating ?? null;
    }
}