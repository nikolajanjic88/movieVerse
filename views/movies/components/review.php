<div class="review-section">

    <h3>
        💬 Your Review
    </h3>


    <form
        action="/reviews/<?= (int) $movie['id'] ?>"
        method="POST"
        class="review-form">

        <textarea
            name="content"
            rows="5"
            placeholder="Write your review..."
            required
        ><?= htmlspecialchars($userReview ?? '') ?></textarea>

        <button
            type="submit"
            class="review-button">
            <?= $userReview !== null
                ? 'Update Review'
                : 'Add Review' ?>
        </button>
    </form>


    <!-- Reviews -->
    <div class="reviews-list">

        <h3>
            💬 Reviews
        </h3>


        <?php if (!empty($reviews)): ?>

            <?php foreach ($reviews as $review): ?>

                <div class="review-card">

                    <div class="review-header">

                        <div>

                            <strong>
                                <?= htmlspecialchars($review->username) ?>
                            </strong>


                            <?php if (
                                !empty($_SESSION['user']) &&
                                (int) $_SESSION['user'] === (int) $review->user_id
                            ): ?>

                                <span class="your-review">
                                    Your review
                                </span>

                            <?php endif; ?>

                        </div>


                        <span>
                            <?= htmlspecialchars($review->created_at) ?>
                        </span>

                    </div>


                    <p>
                        <?= nl2br(
                            htmlspecialchars($review->content)
                        ) ?>
                    </p>


                    <?php if (
                        !empty($_SESSION['user']) &&
                        (int) $_SESSION['user'] === (int) $review->user_id
                    ): ?>

                        <form
                            action="/reviews/<?= (int) $review->id ?>"
                            method="POST"
                            class="delete-review-form">
                            <input
                                type="hidden"
                                name="_method"
                                value="delete">

                            <button
                                type="submit"
                                class="delete-review-button">
                                🗑️ Delete Review
                            </button>

                        </form>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p class="no-reviews">
                No reviews yet. Be the first to write one!
            </p>

        <?php endif; ?>

    </div>

</div>