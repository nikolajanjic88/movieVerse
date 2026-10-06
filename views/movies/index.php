<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<div class="movies-page">
    <h1>🎬 Movie Search</h1>
    <form action="/movies" method="GET" class="movie-search">
        <input
            type="text"
            name="query"
            placeholder="Search for a movie..."
            value="<?= htmlspecialchars($_GET['query'] ?? '') ?>"
        >
        <button type="submit">
            Search
        </button>
    </form>
    <?php if (!empty($movies)): ?>
        <div class="movie-grid">
            <?php foreach ($movies as $movie): ?>
                <?php include BASE_PATH . 'views/movies/components/movie-card.php'; ?>
            <?php endforeach; ?>
        </div>
        <?php include_once BASE_PATH . 'views/inc/pagination.php'; ?>
    <?php elseif (!empty($_GET['query'])): ?>
        <p class="no-results">
            No movies found.
        </p>
    <?php endif; ?>
</div>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>