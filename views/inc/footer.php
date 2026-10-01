<footer>
    <p>
        © 2026 MovieVerse
    </p>
</footer>

<!-- AlertifyJS -->
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- Flash messages -->
<?php
    $success = \Core\Session::get('success');
    $error = \Core\Session::get('error');
?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        alertify.set('notifier', 'position', 'top-center');
        <?php if ($success): ?>

            alertify.success(
                <?= json_encode($success) ?>
            );

        <?php endif; ?>
        <?php if ($error): ?>
            alertify.error(
                <?= json_encode($error) ?>
            );
        <?php endif; ?>
    });
</script>

</body>
</html>