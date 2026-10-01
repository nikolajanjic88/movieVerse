<header class="navbar">

    <div class="logo">
        Movie<span>Verse</span>
    </div>

    <nav>
        <a href="/">Home</a>
        <a href="/movies">Movies</a>
        <a href="/genres">Genres</a>
        <a href="/top-rated">Top Rated</a>

        <?php if (!empty($_SESSION['user'])): ?>
            <a href="/favorites">❤️ Favorites</a>
            <a href="/watchlist">📋 Watchlist</a>
            <a href="/profile">👤 Profile</a>
        <?php endif; ?>
    </nav>

    <div class="nav-actions">

        <?php if (!empty($_SESSION['user'])): ?>

            <form action="/logout" method="POST">
                <input type="hidden" name="_method" value="delete">

                <button class="logout-btn">
                    Logout
                </button>
            </form>

        <?php else: ?>

            <a class="login" href="/login">
                Login
            </a>

        <?php endif; ?>

    </div>

</header>