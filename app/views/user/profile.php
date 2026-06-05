<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/navbar_user.php'; ?>

<div class="container my-5" style="max-width: 650px;">
    <h2 class="fw-bold mb-4"><i class="fa-solid fa-user-circle me-2" style="color: var(--accent-color);"></i> My Profile</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i> <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card p-4 shadow-sm border-0" style="border-radius: 15px;">
        <form action="<?php echo BASE_URL; ?>user/profile" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label fw-medium">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user->name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label fw-medium">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user->username); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user->email); ?>" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label fw-medium">New Password <span class="text-muted small fw-normal">(Leave blank to keep current)</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
            </div>
            
            <button type="submit" class="btn btn-dark py-2 px-4 fw-semibold" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                Save Profile Changes <i class="fa-solid fa-save ms-2"></i>
            </button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
