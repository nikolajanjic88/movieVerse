<?php 
    require_once 'inc/auth_head.php';
?>

<body>
    <div class="overlay"></div>
    <div class="auth-container">
        <div class="logo">
            Movie<span>Verse</span>
        </div>
        <h1>Welcome Back</h1>
        <p class="subtitle">
            Login to continue your movie journey.
        </p>
        <form action="/login" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required>
            </div>
            <div class="options">
                <a href="#">
                    Forgot password?
                </a>
            </div>
            <button type="submit" class="btn">
                Login
            </button>
        </form>
        <p class="bottom-text">
            Don't have an account?
            <a href="/register">Create one</a>
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