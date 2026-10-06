<div class="movie-poster">

    <?php if (!empty($movie['poster_path'])): ?>

        <img
            src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']) ?>"
            alt="<?= htmlspecialchars($movie['title']) ?>">

    <?php else: ?>
        <div class="no-poster">
            No poster available
        </div>
    <?php endif; ?>

</div>