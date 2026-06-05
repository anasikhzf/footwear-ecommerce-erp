<div class="sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="d-flex align-items-center mb-4 mt-2 justify-content-between">
            <div class="d-flex align-items-center">
                <img src="<?php echo BASE_URL; ?>assets/img/logo.png" alt="Logo" width="35" height="35" class="me-2">
                <h5 class="mb-0 text-white font-weight-bold">.MALSHOES</h5>
            </div>
            <!-- Simplified Toggle Theme button in Sidebar -->
            <button class="btn btn-outline-light btn-sm rounded-circle px-2" id="themeToggleBtn" type="button" title="Toggle Theme">
                <i class="fa-solid fa-moon"></i>
            </button>
        </div>

        <hr class="text-secondary">

        <nav class="nav flex-column">
            <a href="<?php echo BASE_URL; ?>admin/dashboard" class="sidebar-item nav-link <?php echo (strpos($_GET['url'] ?? '', 'admin/dashboard') !== false) ? 'active-sidebar-item' : ''; ?>">
                <i class="fa-solid fa-chart-line me-3"></i> Dashboard
            </a>
            
            <div class="text-secondary small fw-bold mt-3 mb-2 px-2 uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">DATA MANAGEMENT</div>
            <a href="<?php echo BASE_URL; ?>admin/categories" class="sidebar-item nav-link <?php echo (strpos($_GET['url'] ?? '', 'admin/categories') !== false) ? 'active-sidebar-item' : ''; ?>">
                <i class="fa-solid fa-tags me-3"></i> Categories
            </a>
            <a href="<?php echo BASE_URL; ?>admin/products" class="sidebar-item nav-link <?php echo (strpos($_GET['url'] ?? '', 'admin/products') !== false) ? 'active-sidebar-item' : ''; ?>">
                <i class="fa-solid fa-shoe-prints me-3"></i> Products
            </a>
            <a href="<?php echo BASE_URL; ?>admin/stock" class="sidebar-item nav-link <?php echo (strpos($_GET['url'] ?? '', 'admin/stock') !== false || strpos($_GET['url'] ?? '', 'admin/request_stock') !== false) ? 'active-sidebar-item' : ''; ?>">
                <i class="fa-solid fa-boxes-stacked me-3"></i> Stock Control
            </a>
            <a href="<?php echo BASE_URL; ?>admin/users" class="sidebar-item nav-link <?php echo (strpos($_GET['url'] ?? '', 'admin/users') !== false) ? 'active-sidebar-item' : ''; ?>">
                <i class="fa-solid fa-users me-3"></i> Users List
            </a>

            <div class="text-secondary small fw-bold mt-3 mb-2 px-2 uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">REPORTS & BILLS</div>
            <a href="<?php echo BASE_URL; ?>admin/sales_report" class="sidebar-item nav-link <?php echo (strpos($_GET['url'] ?? '', 'admin/sales_report') !== false) ? 'active-sidebar-item' : ''; ?>">
                <i class="fa-solid fa-file-invoice-dollar me-3"></i> Sales Report
            </a>
            <a href="<?php echo BASE_URL; ?>admin/finance_report" class="sidebar-item nav-link <?php echo (strpos($_GET['url'] ?? '', 'admin/finance_report') !== false) ? 'active-sidebar-item' : ''; ?>">
                <i class="fa-solid fa-chart-pie me-3"></i> Financial Report
            </a>
            <a href="<?php echo BASE_URL; ?>admin/invoices" class="sidebar-item nav-link <?php echo (strpos($_GET['url'] ?? '', 'admin/invoices') !== false) ? 'active-sidebar-item' : ''; ?>">
                <i class="fa-solid fa-receipt me-3"></i> Supplier Bills
            </a>
        </nav>
    </div>

    <div>
        <hr class="text-secondary">
        <a href="<?php echo BASE_URL; ?>admin/profile" class="sidebar-item nav-link mb-2 <?php echo (strpos($_GET['url'] ?? '', 'admin/profile') !== false) ? 'active-sidebar-item' : ''; ?>">
            <i class="fa-solid fa-user-gear me-3"></i> My Profile
        </a>
        <a href="<?php echo BASE_URL; ?>auth/logout" class="sidebar-item nav-link text-danger">
            <i class="fa-solid fa-right-from-bracket me-3"></i> Sign Out
        </a>
    </div>
</div>
