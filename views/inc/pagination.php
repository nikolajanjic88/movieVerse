<?php if ($totalPages > 1): ?>

<?php
$queryParams = [];

if (!empty($query)) {
    $queryParams['query'] = $query;
}
?>

<div class="pagination">

    <?php if ($currentPage > 1): ?>

        <?php
        $queryParams['page'] = $currentPage - 1;
        ?>

        <a
            href="?<?= http_build_query($queryParams) ?>"
            class="pagination-button"
        >
            ← Previous
        </a>

    <?php endif; ?>

    <span class="pagination-current">
        Page <?= $currentPage ?> of <?= $totalPages ?>
    </span>

    <?php if ($currentPage < $totalPages): ?>

        <?php
        $queryParams['page'] = $currentPage + 1;
        ?>

        <a
            href="?<?= http_build_query($queryParams) ?>"
            class="pagination-button"
        >
            Next →
        </a>

    <?php endif; ?>

</div>

<?php endif; ?>