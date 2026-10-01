<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<div class="movies-page">

    <div class="section-title">

        <h1>
            🎭 <?= htmlspecialchars($genre['name']) ?> Movies
        </h1>

        <a href="/">
            ← Home
        </a>

    </div>


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
                                ⭐
                                <?= number_format(
                                    (float) $movie['vote_average'],
                                    1
                                ) ?>
                            </span>

                            <span>
                                <?= !empty($movie['release_date'])
                                    ? substr($movie['release_date'], 0, 4)
                                    : 'N/A' ?>
                            </span>

                        </div>


                        <p>
                            <?= htmlspecialchars(
                                $movie['overview'] ?? ''
                            ) ?>
                        </p>


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
            <p>No movies found for this genre.</p>
        </div>

    <?php endif; ?>

</div>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>