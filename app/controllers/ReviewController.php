<?php

namespace App\Controllers;

use App\Models\Review;
use Core\Session;

class ReviewController
{
    public function store($movieId)
    {
        $userId = $_SESSION['user'];

        $content = trim($_POST['content'] ?? '');

        // Validation
        if ($content === '') {

            Session::flash(
                'error',
                'Review cannot be empty.'
            );

            return redirect("/movies/{$movieId}");
        }

        // Check existing review
        $existingReview = Review::findByUserAndMovie(
            $userId,
            $movieId
        );

        if ($existingReview) {

            // Update existing review
            $reviewModel = new Review([
                'id' => $existingReview->id,
                'user_id' => $userId,
                'movie_id' => $movieId,
                'content' => $content
            ]);

            $reviewModel->save();

            Session::flash(
                'success',
                'Your review has been updated! ✏️'
            );

        } else {

            // Create new review
            $reviewModel = new Review([
                'user_id' => $userId,
                'movie_id' => $movieId,
                'content' => $content
            ]);

            $reviewModel->save();

            Session::flash(
                'success',
                'Review added successfully! 💬'
            );
        }

        return redirect("/movies/{$movieId}");
    }

    public function destroy($reviewId)
    {
        $userId = $_SESSION['user'];

        $review = Review::deleteByUser(
            $reviewId,
            $userId
        );

        if (!$review) {
            Session::flash(
                'error',
                'You cannot delete this review.'
            );

            return redirect('/');
        }

        Session::flash(
            'success',
            'Review deleted successfully.'
        );

        return redirect("/movies/{$review->movie_id}");
    }
}