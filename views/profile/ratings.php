<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<div class="movies-page">

    <h1>⭐ My Ratings</h1>

    <?php if (!empty($movies)): ?>

        <div class="movie-grid">

            <?php foreach ($movies as $movie): ?>

                <div class="movie-card">

                    <?php if (!empty($movie['poster_path'])): ?>

                        <img
                            src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']) ?>"
                            alt="<?= htmlspecialchars($movie['title']) ?>"
                        >

                    <?php else: ?>

                        <div class="no-poster">
                            No poster
                        </div>

                    <?php endif; ?>

                    <div class="movie-card-content">

                        <h2>
                            <?= htmlspecialchars($movie['title']) ?>
                        </h2>

                        <div class="movie-card-meta">

                            <span>
                                ⭐ Your rating:
                                <strong>
                                    <?= (int) $movie['user_rating'] ?>/10
                                </strong>
                            </span>

                            <?php if (!empty($movie['release_date'])): ?>
                                <span>
                                    <?= substr(
                                        $movie['release_date'],
                                        0,
                                        4
                                    ) ?>
                                </span>
                            <?php endif; ?>

                        </div>

                        <a
                            href="/movies/<?= (int) $movie['id'] ?>"
                            class="details-button"
                        >
                            View Details
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="no-results">
            <p>You haven't rated any movies yet.</p>

            <a href="/movies" class="details-button">
                Browse Movies
            </a>
        </div>

    <?php endif; ?>

</div>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>