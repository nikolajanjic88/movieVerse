<?php if (!empty($cast)): ?>

    <div class="cast-section">

        <h2>🎭 Cast</h2>

        <div class="cast-grid">

            <?php foreach ($cast as $actor): ?>

                <div class="cast-card">

                    <?php if (!empty($actor['profile_path'])): ?>

                        <img
                            src="https://image.tmdb.org/t/p/w185<?= htmlspecialchars($actor['profile_path']) ?>"
                            alt="<?= htmlspecialchars($actor['name']) ?>">

                    <?php else: ?>

                        <div class="cast-no-image">
                            No image
                        </div>

                    <?php endif; ?>

                    <div class="cast-info">

                        <strong>
                            <?= htmlspecialchars($actor['name']) ?>
                        </strong>

                        <?php if (!empty($actor['character'])): ?>

                            <span>
                                <?= htmlspecialchars($actor['character']) ?>
                            </span>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

<?php endif; ?>