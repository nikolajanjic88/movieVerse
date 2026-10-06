<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<div class="movie-details">

    <?php if (!empty($movie['backdrop_path'])): ?>

        <div
            class="movie-backdrop"
            style="background-image: url('https://image.tmdb.org/t/p/original<?= htmlspecialchars($movie['backdrop_path']) ?>');">
        </div>

    <?php endif; ?>


    <div class="movie-content">

        <!-- Poster -->
        <?php include_once BASE_PATH . 'views/movies/components/poster.php'; ?>

        <!-- Movie information -->
        <div class="movie-info">
            <h1>
                <?= htmlspecialchars($movie['title']) ?>
            </h1>

            <?php if (!empty($movie['tagline'])): ?>
                <p class="tagline">
                    <?= htmlspecialchars($movie['tagline']) ?>
                </p>
            <?php endif; ?>

            <!-- Movie meta -->
            <?php include_once BASE_PATH . 'views/movies/components/movie-meta.php'; ?>


            <!-- Genres -->
            <?php include_once BASE_PATH . 'views/movies/components/genres.php'; ?>


            <!-- Overview -->
            <h2>Overview</h2>

            <p class="overview">
                <?= htmlspecialchars(
                    $movie['overview'] ?? 'No description available.'
                ) ?>
            </p>


            <!-- Original title -->
            <?php if (!empty($movie['original_title'])): ?>

                <p class="original-title">
                    <strong>Original title:</strong>
                    <?= htmlspecialchars($movie['original_title']) ?>
                </p>

            <?php endif; ?>

            <!-- Director -->
            <?php include_once BASE_PATH . 'views/movies/components/director.php'; ?>

            <!-- Cast -->    
            <?php include_once BASE_PATH . 'views/movies/components/cast.php'; ?>

            <!-- Trailer -->
            <?php include_once BASE_PATH . 'views/movies/components/trailer.php'; ?>
            
            <!-- Production -->  
            <?php include_once BASE_PATH . 'views/movies/components/production.php'; ?>  
            
       
            <?php if (!empty($_SESSION['user'])): ?>

                <!-- Actions -->
                <?php include_once BASE_PATH . 'views/movies/components/actions.php'; ?>


                <!-- Rating -->
                <?php include_once BASE_PATH . 'views/movies/components/rating.php'; ?>


                <!-- Review -->
                <?php include_once BASE_PATH . 'views/movies/components/review.php'; ?>
                

            <?php else: ?>

                <!-- Guest message -->
                <div class="guest-actions">

                    <p>
                        Login to add this movie to your Favorites or Watchlist,
                        rate it and write a review.
                    </p>

                    <a href="/login" class="login-movie-button">
                        Login
                    </a>

                </div>

            <?php endif; ?>

            <!-- Back -->
            <a href="/movies" class="back-button">
                ← Back to movies
            </a>

        </div>

    </div>

    <!-- Similar movies -->
    <?php include_once BASE_PATH . 'views/movies/components/similar-movies.php'; ?>

</div>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>