<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<div class="profile-page">

    <div class="profile-header">

        <div class="profile-avatar">
            👤
        </div>

        <div>
            <h1>
                <?= htmlspecialchars($user->username) ?>
            </h1>

            <p>
                <?= htmlspecialchars($user->email) ?>
            </p>
        </div>

    </div>

    <div class="profile-stats">

        <a href="/favorites" class="stat-card">
            <span class="stat-icon">❤️</span>
            <strong><?= $favoritesCount ?></strong>
            <span>Favorites</span>
        </a>

        <a href="/watchlist" class="stat-card">
            <span class="stat-icon">📋</span>
            <strong><?= $watchlistCount ?></strong>
            <span>Watchlist</span>
        </a>

        <a href="/profile/ratings" class="stat-card">
            <span class="stat-icon">⭐</span>
            <strong><?= $ratingsCount ?></strong>
            <span>Ratings</span>
        </a>

        <a href="/profile/reviews" class="stat-card">
            <span class="stat-icon">💬</span>
            <strong><?= $reviewsCount ?></strong>
            <span>Reviews</span>
        </a>

    </div>

</div>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>