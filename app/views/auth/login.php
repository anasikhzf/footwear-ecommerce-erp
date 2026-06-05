<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 420px; border-radius: 15px;">
        <div class="text-center mb-4">
            <img src="<?php echo BASE_URL; ?>assets/img/logo.png" alt="Logo" width="70" class="mb-2">
            <h3 class="fw-bold">Welcome Back!</h3>
            <p class="text-muted small">Sign in to access your Malshoes account</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['login'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> <?php echo $_SESSION['login']; unset($_SESSION['login']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['logout_success'])): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-info me-2"></i> Logged out successfully!
                <?php unset($_SESSION['logout_success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>auth/login" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label fw-medium">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label fw-medium">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-dark py-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Sign In
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            <p class="small text-muted mb-0">Don't have an account? <a href="<?php echo BASE_URL; ?>auth/register" class="fw-bold text-decoration-none" style="color: var(--accent-color);">Sign Up</a></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
