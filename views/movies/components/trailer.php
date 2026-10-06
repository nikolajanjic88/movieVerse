<?php if (!empty($trailer)): ?>

    <div class="trailer-section">

        <h2>🎬 Official Trailer</h2>

        <div class="trailer-container">

            <iframe
                src="https://www.youtube.com/embed/<?= htmlspecialchars($trailer['key']) ?>"
                title="<?= htmlspecialchars($trailer['name']) ?>"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
            ></iframe>

        </div>

    </div>

<?php endif; ?>