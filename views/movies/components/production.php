<?php if (
    !empty($movie['budget']) ||
    !empty($movie['revenue']) ||
    !empty($movie['production_companies'])
): ?>

    <div class="production-section">

        <h2>🎥 Production</h2>

        <div class="production-grid">

            <?php if (!empty($movie['budget'])): ?>

                <div class="production-item">

                    <span class="production-label">
                        Budget
                    </span>

                    <strong>
                        $<?= number_format((float) $movie['budget']) ?>
                    </strong>

                </div>

            <?php endif; ?>


            <?php if (!empty($movie['revenue'])): ?>

                <div class="production-item">

                    <span class="production-label">
                        Box Office
                    </span>

                    <strong>
                        $<?= number_format((float) $movie['revenue']) ?>
                    </strong>

                </div>

            <?php endif; ?>

        </div>


        <?php if (!empty($movie['production_companies'])): ?>

            <div class="production-companies">

                <h3>Production Companies</h3>

                <div class="company-list">

                    <?php foreach ($movie['production_companies'] as $company): ?>

                        <div class="company-card">

                            <?php if (!empty($company['logo_path'])): ?>

                                <img
                                    src="https://image.tmdb.org/t/p/w200<?= htmlspecialchars($company['logo_path']) ?>"
                                    alt="<?= htmlspecialchars($company['name']) ?>"
                                >

                            <?php endif; ?>

                            <span>
                                <?= htmlspecialchars($company['name']) ?>
                            </span>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endif; ?>

    </div>

<?php endif; ?>