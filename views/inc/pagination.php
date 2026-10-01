<?php if ($totalPages > 1): ?>

    <div class="pagination">

        <?php if ($currentPage > 1): ?>
            <a
                href="?page=<?= $currentPage - 1 ?>"
                class="pagination-button">
                ← Previous
            </a>
        <?php endif; ?>

        <span class="pagination-current">
            Page <?= $currentPage ?> of <?= $totalPages ?>
        </span>

        <?php if ($currentPage < $totalPages): ?>
            <a
                href="?page=<?= $currentPage + 1 ?>"
                class="pagination-button">
                Next →
            </a>
        <?php endif; ?>

    </div>

<?php endif; ?>
