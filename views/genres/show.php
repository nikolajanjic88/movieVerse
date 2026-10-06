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

                <?php include BASE_PATH . 'views/movies/components/movie-card.php'; ?>

            <?php endforeach; ?>

        </div>

        <?php include BASE_PATH . 'views/inc/pagination.php'; ?>

    <?php else: ?>

        <div class="no-results">
            <p>No movies found for this genre.</p>
        </div>

    <?php endif; ?>

</div>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>