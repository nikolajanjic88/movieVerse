<?php

namespace App\Models;

use Core\Model;

class Review extends Model
{
    protected static $table = 'reviews';

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

    public static function getByMovie($movieId)
    {
        return static::query()
            ->select(
                'reviews.id',
                'reviews.user_id',
                'reviews.movie_id',
                'reviews.content',
                'reviews.created_at',
                'users.username'
            )
            ->join(
                'users',
                'reviews.user_id',
                '=',
                'users.id'
            )
            ->where(
                'reviews.movie_id',
                '=',
                $movieId
            )
            ->orderBy(
                'reviews.created_at',
                'DESC'
            )
            ->get();
    }

    public static function getUserReview($userId, $movieId)
    {
        $review = static::findByUserAndMovie(
            $userId,
            $movieId
        );

        return $review ? $review->content : null;
    }

    public static function deleteByUser($reviewId, $userId)
    {
        $review = static::where(
            'id',
            '=',
            $reviewId
        )->where(
            'user_id',
            '=',
            $userId
        )->first();

        if (!$review) {
            return null;
        }

        $reviewModel = new static([
            'id' => $review->id
        ]);

        $deleted = $reviewModel->delete();

        if (!$deleted) {
            return null;
        }

        return $review;
    }
}