<?php include_once 'inc/header.php' ?>

<?php include_once 'inc/nav.php' ?>

<?php include_once 'inc/hero.php' ?>


<!-- TRENDING -->

<section class="section">

    <div class="section-title">

        <h2>
            🔥 Trending This Week
        </h2>

        <a href="/movies">
            View all →
        </a>

    </div>

    <div class="movie-grid">
        <?php foreach (array_slice($trending, 0, 4) as $movie): ?>
            <div class="movie-card">
                <?php if (!empty($movie['poster_path'])): ?>
                    <img
                        src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']) ?>"
                        alt="<?= htmlspecialchars($movie['title']) ?>">
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
                                : 'N/A' ?>
                        </span>
                    </div>
                    <a
                        href="/movies/<?= (int) $movie['id'] ?>"
                        class="details-button">
                        View Details
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>

<!-- GENRES -->

<section class="section">
    <div class="section-title">
        <h2>
            🎭 Browse by Genre
        </h2>
        <a href="/genres">
            View all →
        </a>
    </div>

    <div class="genres">
        <?php foreach (array_slice($genres, 0, 7) as $genre): ?>
            <a
                href="/genres/<?= (int) $genre['id'] ?>"
                class="genre-card">
                <?= htmlspecialchars($genre['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>

</section>


<!-- COMMUNITY -->

<section class="stats">
    <div class="stat">
        <h2>
            1M+
        </h2>
        <p>
            Movies
        </p>
    </div>

    <div class="stat">
        <h2>
            500K+
        </h2>
        <p>
            Reviews
        </p>
    </div>

    <div class="stat">
        <h2>
            100K+
        </h2>
        <p>
            Users
        </p>
    </div>

</section>


<?php include_once 'inc/footer.php' ?>