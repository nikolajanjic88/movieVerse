<div class="movie-actions">

    <!-- Favorite -->
    <?php if ($isFavorite): ?>

        <form
            action="/favorites/<?= (int) $movie['id'] ?>"
            method="POST">
            <input
                type="hidden"
                name="_method"
                value="delete">

            <button
                type="submit"
                class="favorite-button remove">
                💔 Remove from Favorites
            </button>
        </form>

    <?php else: ?>

        <form
            action="/favorites/<?= (int) $movie['id'] ?>"
            method="POST">

            <button
                type="submit"
                class="favorite-button">
                ❤️ Add to Favorites
            </button>
        </form>

    <?php endif; ?>


    <!-- Watchlist -->
    <?php if ($isWatchlisted): ?>

        <form
            action="/watchlist/<?= (int) $movie['id'] ?>"
            method="POST">
            <input
                type="hidden"
                name="_method"
                value="delete">

            <button
                type="submit"
                class="watchlist-button remove">
                ❌ Remove from Watchlist
            </button>
        </form>

    <?php else: ?>

        <form
            action="/watchlist/<?= (int) $movie['id'] ?>"
            method="POST">
            <button
                type="submit"
                class="watchlist-button">
                📋 Add to Watchlist
            </button>
        </form>

    <?php endif; ?>

</div>