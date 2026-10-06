<?php if (!empty($director)): ?>

    <div class="director-section">

        <h2>🎬 Director</h2>

        <div class="director-card">

            <?php if (!empty($director['profile_path'])): ?>

                <img
                    src="https://image.tmdb.org/t/p/w185<?= htmlspecialchars($director['profile_path']) ?>"
                    alt="<?= htmlspecialchars($director['name']) ?>"
                >

            <?php endif; ?>

            <div class="director-info">

                <strong>
                    <?= htmlspecialchars($director['name']) ?>
                </strong>

                <span>
                    Director
                </span>

            </div>

        </div>

    </div>

<?php endif; ?>