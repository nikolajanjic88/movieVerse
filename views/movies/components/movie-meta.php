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