<?php if (!empty($similarMovies)): ?>

    <div class="similar-section">

        <h2>🎬 You May Also Like</h2>

        <div class="similar-grid">

            <?php foreach ($similarMovies as $similar): ?>

                <a
                    href="/movies/<?= (int) $similar['id'] ?>"
                    class="similar-card"
                >

                    <?php if (!empty($similar['poster_path'])): ?>

                        <img
                            src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($similar['poster_path']) ?>"
                            alt="<?= htmlspecialchars($similar['title']) ?>"
                        >

                    <?php else: ?>

                        <div class="similar-no-poster">
                            No poster
                        </div>

                    <?php endif; ?>

                    <div class="similar-info">

                        <h3>
                            <?= htmlspecialchars($similar['title']) ?>
                        </h3>

                        <div class="similar-meta">

                            <?php if (!empty($similar['release_date'])): ?>

                                <span>
                                    <?= htmlspecialchars(
                                        substr($similar['release_date'], 0, 4)
                                    ) ?>
                                </span>

                            <?php endif; ?>

                            <?php if (isset($similar['vote_average'])): ?>

                                <span>
                                    ⭐ <?= number_format(
                                        (float) $similar['vote_average'],
                                        1
                                    ) ?>
                                </span>

                            <?php endif; ?>

                        </div>

                    </div>

                </a>

            <?php endforeach; ?>

        </div>

    </div>

<?php endif; ?>