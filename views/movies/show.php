<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<div class="movie-details">
    <?php if (!empty($movie['backdrop_path'])): ?>
        <div
            class="movie-backdrop"
            style="background-image: url('https://image.tmdb.org/t/p/original<?= htmlspecialchars($movie['backdrop_path']) ?>');">
        </div>
    <?php endif; ?>
    <div class="movie-content">
        <div class="movie-poster">
            <?php if (!empty($movie['poster_path'])): ?>
                <img
                    src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']) ?>"
                    alt="<?= htmlspecialchars($movie['title']) ?>"
                >
            <?php else: ?>
                <div class="no-poster">
                    No poster available
                </div>
            <?php endif; ?>
        </div>
        <div class="movie-info">
            <h1>
                <?= htmlspecialchars($movie['title']) ?>
            </h1>
            <?php if (!empty($movie['tagline'])): ?>
                <p class="tagline">
                    <?= htmlspecialchars($movie['tagline']) ?>
                </p>
            <?php endif; ?>
            <div class="movie-meta">
                <?php if (!empty($movie['release_date'])): ?>
                    <span>
                        📅 <?= htmlspecialchars(substr($movie['release_date'], 0, 4)) ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($movie['runtime'])): ?>
                    <span>
                        ⏱ <?= htmlspecialchars($movie['runtime']) ?> min
                    </span>
                <?php endif; ?>
                <?php if (isset($movie['vote_average'])): ?>
                    <span>
                        ⭐ <?= number_format((float) $movie['vote_average'], 1) ?>
                    </span>
                <?php endif; ?>
            </div>
            <?php if (!empty($movie['genres'])): ?>
                <div class="genres">
                    <?php foreach ($movie['genres'] as $genre): ?>
                        <span class="genre">
                            <?= htmlspecialchars($genre['name']) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <h2>Overview</h2>
            <p class="overview">
                <?= htmlspecialchars(
                    $movie['overview'] ?? 'No description available.'
                ) ?>
            </p>
            <?php if (!empty($movie['original_title'])): ?>
                <p>
                    <strong>Original title:</strong>
                    <?= htmlspecialchars($movie['original_title']) ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($_SESSION['user'])): ?>
                <?php if ($isFavorite): ?>
                    <form action="/favorites/<?= (int) $movie['id'] ?> "method="POST">
                        <input
                            type="hidden"
                            name="_method"
                            value="delete"
                        >
                        <button type="submit" class="favorite-button remove">
                            💔 Remove from Favorites
                        </button>
                    </form>
                <?php else: ?>
                    <form
                        action="/favorites/<?= (int) $movie['id'] ?>" method="POST">
                        <button type="submit" class="favorite-button">
                            ❤️ Add to Favorites
                        </button>
                    </form>
                <?php endif; ?>

                <?php if ($isWatchlisted): ?>

                    <form action="/watchlist/<?= (int) $movie['id'] ?>"method="POST">
                        <input
                            type="hidden"
                            name="_method"
                            value="delete">
                        <button type="submit" class="watchlist-button remove">
                            ❌ Remove from Watchlist
                        </button>
                    </form>

                <?php else: ?>
                    <form
                        action="/watchlist/<?= (int) $movie['id'] ?>" method="POST">
                        <button type="submit" class="watchlist-button">
                            📋 Add to Watchlist
                        </button>
                    </form>
                <?php endif; ?>

                <div class="rating-section">

                    <h3>⭐ MovieVerse Rating</h3>

                    <?php if ($averageRating !== null): ?>
                        <p class="average-rating">
                            Community rating:
                            <strong>
                                <?= number_format((float) $averageRating, 1) ?>/10
                            </strong>
                        </p>
                    <?php else: ?>
                        <p class="average-rating">
                            No ratings yet.
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['user'])): ?>
                        <form
                            action="/ratings/<?= (int) $movie['id'] ?>" method="POST" class="rating-form">
                            <label for="rating">
                                <?= $userRating !== null
                                    ? 'Change your rating:'
                                    : 'Rate this movie:' ?>
                            </label>
                            <select name="rating" id="rating" required>
                                <option value="">
                                    Select rating
                                </option>
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option
                                        value="<?= $i ?>"
                                        <?= $userRating == $i ? 'selected' : '' ?>>
                                        <?= $i ?>/10
                                    </option>
                                <?php endfor; ?>
                            </select>
                            <button type="submit" class="rating-button">
                                <?= $userRating !== null
                                    ? 'Update Rating'
                                    : 'Rate Movie' ?>
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="rating-login">
                            Login to rate this movie.
                        </p>
                    <?php endif; ?>
                </div>
                <div class="review-section">

                <h3>💬 Your Review</h3>

                <?php if (!empty($_SESSION['user'])): ?>

                    <form
                        action="/reviews/<?= (int) $movie['id'] ?>"
                        method="POST"
                        class="review-form"
                    >

                        <textarea
                            name="content"
                            rows="5"
                            placeholder="Write your review..."
                            required
                        ><?= htmlspecialchars($userReview ?? '') ?></textarea>

                        <button type="submit" class="review-button">
                            <?= $userReview !== null
                                ? 'Update Review'
                                : 'Add Review' ?>
                        </button>

                    </form>

                    <div class="reviews-list">

                        <h3>💬 Reviews</h3>

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
                                        <?= nl2br(htmlspecialchars($review->content)) ?>
                                    </p>


                                    <?php if (
                                        !empty($_SESSION['user']) &&
                                        (int) $_SESSION['user'] === (int) $review->user_id
                                    ): ?>

                                        <form
                                            action="/reviews/<?= (int) $review->id ?>"
                                            method="POST"
                                            class="delete-review-form"
                                        >

                                            <input
                                                type="hidden"
                                                name="_method"
                                                value="delete"
                                            >

                                            <button
                                                type="submit"
                                                class="delete-review-button"
                                            >
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

                <?php else: ?>

                    <p class="review-login">
                        Login to write a review.
                    </p>

                <?php endif; ?>

            </div>
            <?php endif; ?>

            <a href="/movies" class="back-button">
                ← Back to movies
            </a>
        </div>
    </div>
</div>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>