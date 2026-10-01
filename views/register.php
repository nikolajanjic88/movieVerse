<?php 
    require_once 'inc/auth_head.php';
?>

<body>

    <div class="overlay"></div>

    <div class="auth-container">

        <div class="logo">
            Movie<span>Verse</span>
        </div>

        <h1>Create Account</h1>

        <p class="subtitle">
            Join MovieVerse today.
        </p>

        <form action="/register" method="POST">

            <div class="form-group">
                <label>Username</label>
                <input
                    type="text"
                    name="username"
                    placeholder="Choose a username">
                <?php if(isset($errors['username'])): ?>
                <p class="error-message"><?= $errors['username'][0] ?></p>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email">
                <?php if(isset($errors['email'])): ?>
                <p class="error-message"><?= $errors['email'][0] ?></p>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Create password">
                <?php if(isset($errors['password'])): ?>
                <p class="error-message"><?= $errors['password'][0] ?></p>
                <?php endif ?>
            </div>

            <div class="form-group">

                <label>Confirm Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm password">
            </div>

            <button class="btn">
                Create Account
            </button>

        </form>

        <p class="bottom-text">
            Already have an account?
            <a href="/login">Login</a>
        </p>

    </div>

<!-- AlertifyJS -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Flash messages -->
    <?php 
        $success = \Core\Session::get('success'); 
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            alertify.set('notifier', 'position', 'top-right');
            <?php if($success): ?>
                alertify.success("<?= addslashes($success) ?>");
            <?php endif; ?>
        });
    </script>
</body>
</html>