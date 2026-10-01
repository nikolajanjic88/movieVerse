<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<div class="movies-page">

    <h1>💬 My Reviews</h1>

    <?php if (!empty($movies)): ?>

        <div class="profile-reviews">

            <?php foreach ($movies as $movie): ?>

                <div class="profile-review-card">

                    <div class="profile-review-movie">

                        <?php if (!empty($movie['poster_path'])): ?>

                            <img
                                src="https://image.tmdb.org/t/p/w200<?= htmlspecialchars($movie['poster_path']) ?>"
                                alt="<?= htmlspecialchars($movie['title']) ?>"
                            >

                        <?php endif; ?>

                        <div>

                            <h2>
                                <?= htmlspecialchars($movie['title']) ?>
                            </h2>

                            <?php if (!empty($movie['release_date'])): ?>
                                <span class="review-year">
                                    <?= substr(
                                        $movie['release_date'],
                                        0,
                                        4
                                    ) ?>
                                </span>
                            <?php endif; ?>

                        </div>

                    </div>

                    <div class="profile-review-content">

                        <p>
                            <?= nl2br(
                                htmlspecialchars(
                                    $movie['review_content']
                                )
                            ) ?>
                        </p>

                        <small>
                            <?= htmlspecialchars(
                                $movie['review_created_at']
                            ) ?>
                        </small>

                    </div>

                    <a
                        href="/movies/<?= (int) $movie['id'] ?>"
                        class="details-button"
                    >
                        View Details
                    </a>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="no-results">

            <p>
                You haven't written any reviews yet.
            </p>

            <a href="/movies" class="details-button">
                Browse Movies
            </a>

        </div>

    <?php endif; ?>

</div>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>