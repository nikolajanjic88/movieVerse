<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<div class="movies-page">

    <h1>📋 My Watchlist</h1>

    <?php if (!empty($movies)): ?>
        <div class="movie-grid">
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card">
                    <?php if (!empty($movie['poster_path'])): ?>
                        <img
                            src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']) ?>"
                            alt="<?= htmlspecialchars($movie['title']) ?>">
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
                            <?php if (!empty($movie['release_date'])): ?>
                                <span>
                                    📅 <?= htmlspecialchars(substr($movie['release_date'], 0, 4)) ?>
                                </span>
                            <?php endif; ?>
                            <?php if (isset($movie['vote_average'])): ?>
                                <span>
                                    ⭐ <?= number_format((float) $movie['vote_average'], 1) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <p>
                            <?= htmlspecialchars(
                                $movie['overview'] ?? 'No description available.'
                            ) ?>
                        </p>
                        <a
                            href="/movies/<?= (int) $movie['id'] ?>"
                            class="details-button">
                            View Details
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="no-results">
            Your watchlist is empty.
        </p>
        <a href="/movies" class="details-button">
            Browse Movies
        </a>
    <?php endif; ?>
</div>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>