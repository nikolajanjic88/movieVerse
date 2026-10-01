<?php include_once BASE_PATH . 'views/inc/header.php'; ?>

<?php include_once BASE_PATH . 'views/inc/nav.php'; ?>

<main class="container genres-page">

    <section>

        <div class="genres-header">
            <h1>🎭 Movie Genres</h1>

            <p>
                Browse movies by your favourite genre.
            </p>
        </div>

        <div class="genres">

            <?php foreach ($genres as $genre): ?>

                <a
                    href="/genres/<?= (int) $genre['id'] ?>"
                    class="genre-card"
                    <?php if (!empty($genre['backdrop'])): ?>
                        style="
                            background-image:
                                linear-gradient(
                                    to top,
                                    rgba(0, 0, 0, 0.9),
                                    rgba(0, 0, 0, 0.25)
                                ),
                                url('https://image.tmdb.org/t/p/w780<?= htmlspecialchars($genre['backdrop']) ?>');
                        "
                    <?php endif; ?>
                >

                    <span class="genre-name">
                        <?= htmlspecialchars($genre['name']) ?>
                    </span>

                </a>

            <?php endforeach; ?>

        </div>

    </section>

</main>

<?php include_once BASE_PATH . 'views/inc/footer.php'; ?>