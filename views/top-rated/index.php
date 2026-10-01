<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<main class="container top-rated-page">

    <section>

        <div class="top-rated-header">
            <h1>⭐ Top Rated Movies</h1>

            <p>
                Discover some of the highest-rated movies.
            </p>
        </div>

        <div class="movie-grid">

            <?php foreach ($movies as $movie): ?>

                <div class="movie-card">

                    <?php if (!empty($movie['poster_path'])): ?>

                        <img
                            src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']) ?>"
                            alt="<?= htmlspecialchars($movie['title']) ?>"
                        >

                    <?php endif; ?>

                    <div class="movie-info">

                        <h3>
                            <?= htmlspecialchars($movie['title']) ?>
                        </h3>

                        <div class="movie-meta">

                            <span>
                                ⭐ <?= number_format(
                                    (float) $movie['vote_average'],
                                    1
                                ) ?>
                            </span>

                            <span>
                                <?= !empty($movie['release_date'])
                                    ? substr($movie['release_date'], 0, 4)
                                    : 'N/A'
                                ?>
                            </span>

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

        <?php include_once BASE_PATH . 'views/inc/pagination.php'; ?>

    </section>

</main>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>
