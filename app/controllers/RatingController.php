<?php

namespace App\Controllers;

use App\Models\Rating;
use Core\Session;

class RatingController
{
    public function store($movieId)
    {
        $userId = $_SESSION['user'];

        $rating = (int) ($_POST['rating'] ?? 0);

        // Validation
        if ($rating < 1 || $rating > 10) {

            Session::flash(
                'error',
                'Rating must be between 1 and 10.'
            );

            return redirect("/movies/{$movieId}");
        }

        // Check existing rating
        $existingRating = Rating::findByUserAndMovie(
            $userId,
            $movieId
        );

        if ($existingRating) {

            // Update existing rating
            $ratingModel = new Rating([
                'id' => $existingRating->id,
                'user_id' => $userId,
                'movie_id' => $movieId,
                'rating' => $rating
            ]);

            $ratingModel->save();

            Session::flash(
                'success',
                'Your rating has been updated! ⭐'
            );

        } else {

            // Create new rating
            $ratingModel = new Rating([
                'user_id' => $userId,
                'movie_id' => $movieId,
                'rating' => $rating
            ]);

            $ratingModel->save();

            Session::flash(
                'success',
                'Movie rated successfully! ⭐'
            );
        }

        return redirect("/movies/{$movieId}");
    }
}