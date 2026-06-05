    <!-- jQuery CDN (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS & Bootstrap 5 wrapper CDN -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Theme Switcher script -->
    <script>
        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('malshoes_theme', newTheme);
            updateThemeToggleIcon(newTheme);
        }

        function updateThemeToggleIcon(theme) {
            const btn = document.getElementById('themeToggleBtn');
            if (btn) {
                if (theme === 'dark') {
                    btn.innerHTML = '<i class="fa-solid fa-sun text-warning"></i>';
                } else {
                    btn.innerHTML = '<i class="fa-solid fa-moon"></i>';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('malshoes_theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            updateThemeToggleIcon(savedTheme);

            const toggleBtn = document.getElementById('themeToggleBtn');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    toggleTheme();
                });
            }

            // Global DataTables initialization for all tables except cart or explicitly excluded tables
            if (typeof $.fn.DataTable !== 'undefined') {
                $('table:not(.table-borderless):not(.no-datatable)').each(function() {
                    // Initialize if not already initialized
                    if (!$.fn.DataTable.isDataTable(this)) {
                        $(this).DataTable({
                            pageLength: 10,
                            responsive: true,
                            ordering: true,
                            lengthMenu: [5, 10, 25, 50]
                        });
                    }
                });
            }
        });
    </script>

    <!-- Cart Synchronization script for logged in users -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <script>
            (function() {
                let localCart = JSON.parse(localStorage.getItem('malshoes_cart')) || [];
                if (localCart.length > 0) {
                    fetch('<?php echo BASE_URL; ?>user/sync_cart', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ cart: localCart })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            localStorage.removeItem('malshoes_cart');
                            window.location.reload();
                        }
                    })
                    .catch(err => console.error("Sync error:", err));
                }
            })();
        </script>
    <?php endif; ?>
</body>
</html>
