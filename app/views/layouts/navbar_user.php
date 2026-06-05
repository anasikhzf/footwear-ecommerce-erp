<nav class="navbar navbar-expand-lg custom-navbar py-3">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="<?php echo BASE_URL; ?>user/dashboard">
            <img src="<?php echo BASE_URL; ?>assets/img/logo.png" alt="Logo" width="35" height="35" class="me-2">
            <span>.MALSHOES</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser" aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarUser">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link <?php echo (($_GET['url'] ?? '') === 'user/dashboard') ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>user/dashboard">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($_GET['url'] ?? '', 'user/collection') !== false) ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>user/collection">Collection</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#aboutUsModal">About Us</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($_GET['url'] ?? '', 'user/profile') !== false) ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>user/profile">Profile</a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <div class="d-flex align-items-center gap-3">
                <!-- Search Form -->
                <form action="<?php echo BASE_URL; ?>user/collection" method="GET" class="d-flex">
                    <div class="input-group">
                        <input class="form-control form-control-sm" type="search" name="search_query" placeholder="Search shoes..." aria-label="Search" value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
                        <button class="btn btn-dark btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

                <!-- Simplified Theme Switcher Toggle Button (Icon Only) -->
                <button class="btn btn-outline-secondary btn-sm" id="themeToggleBtn" type="button" title="Toggle Light/Dark Theme">
                    <i class="fa-solid fa-moon"></i>
                </button>

                <!-- Shopping Cart Link -->
                <a href="<?php echo BASE_URL; ?>user/cart" class="btn btn-outline-dark btn-sm position-relative" style="border-color: var(--border-color); color: var(--text-color);">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php
                        $db = new \App\Core\Database();
                        $db->query("SELECT COUNT(*) as total FROM cart WHERE user_id = :uid");
                        $db->bind(':uid', $_SESSION['user_id']);
                        $cart_count = $db->single();
                        $cnt = $cart_count ? $cart_count->total : 0;
                        if ($cnt > 0):
                        ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $cnt; ?>
                            </span>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Guest JS Badge -->
                        <span id="guestCartBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">0</span>
                    <?php endif; ?>
                </a>

                <!-- Auth Check -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                            <i class="fa-solid fa-user me-1"></i> <?php echo htmlspecialchars($_SESSION['user_nama']); ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>user/profile"><i class="fa-solid fa-user-circle me-2"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?php echo BASE_URL; ?>auth/logout"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <!-- Guest Login Button -->
                    <a href="<?php echo BASE_URL; ?>auth/login" class="btn btn-dark btn-sm" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Sign In
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- About Us Modal -->
<div class="modal fade" id="aboutUsModal" tabindex="-1" aria-labelledby="aboutUsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="aboutUsModalLabel">About .MALSHOES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Welcome to <strong>.MALSHOES</strong>, your number one source for premium-quality footwear. We are dedicated to giving you the absolute best style, design, durability, and comfort.</p>
                <p>Founded in 2024, our store offers premium Sports, Casual, and Formal shoes tailored for your daily comfort. We strive to provide excellent customer service and premium products.</p>
                <p class="mb-0"><strong>Contact Us:</strong> info@malshoes.com | Sidoarjo, Jawa Timur</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Guest Cart Count Update Script -->
<?php if (!isset($_SESSION['user_id'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cart = JSON.parse(localStorage.getItem('malshoes_cart')) || [];
        const badge = document.getElementById('guestCartBadge');
        if (badge && cart.length > 0) {
            // Sum of quantity
            const totalQty = cart.reduce((sum, item) => sum + parseInt(item.quantity), 0);
            badge.textContent = totalQty;
            badge.classList.remove('d-none');
        }
    });
</script>
<?php endif; ?>
