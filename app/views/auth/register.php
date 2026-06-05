<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 420px; border-radius: 15px;">
        <div class="text-center mb-4">
            <img src="<?php echo BASE_URL; ?>assets/img/logo.png" alt="Logo" width="70" class="mb-2">
            <h3 class="fw-bold">Create Account</h3>
            <p class="text-muted small">Register a new customer account to start shopping</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>auth/register" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label fw-medium">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user-tag"></i></span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full name" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label fw-medium">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label fw-medium">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-dark py-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                    <i class="fa-solid fa-user-plus me-2"></i> Register
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            <p class="small text-muted mb-0">Already have an account? <a href="<?php echo BASE_URL; ?>auth/login" class="fw-bold text-decoration-none" style="color: var(--accent-color);">Sign In</a></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
