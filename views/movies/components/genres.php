<?php if (!empty($movie['genres'])): ?>

    <div class="genres">

        <?php foreach ($movie['genres'] as $genre): ?>
            <span class="genre">
                <?= htmlspecialchars($genre['name']) ?>
            </span>
        <?php endforeach; ?>

    </div>

<?php endif; ?>