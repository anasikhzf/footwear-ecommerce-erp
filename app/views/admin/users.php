<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex">
    <!-- Sidebar -->
    <?php include __DIR__ . '/../layouts/sidebar_admin.php'; ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">User Accounts</h3>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addUserModal" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                <i class="fa-solid fa-user-plus me-2"></i> Add Account
            </button>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Users Table Card -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="py-3 ps-4" style="width: 60px;">No</th>
                                <th scope="col" class="py-3">Full Name</th>
                                <th scope="col" class="py-3">Username</th>
                                <th scope="col" class="py-3">Email Address</th>
                                <th scope="col" class="py-3">Role</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($users as $u): 
                            ?>
                            <tr>
                                <td class="ps-4 fw-semibold"><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($u->user_nama); ?></td>
                                <td><?php echo htmlspecialchars($u->username); ?></td>
                                <td><?php echo htmlspecialchars($u->user_email); ?></td>
                                <td>
                                    <?php if ($u->role === 'admin'): ?>
                                        <span class="badge bg-danger">Admin</span>
                                    <?php elseif ($u->role === 'supplier'): ?>
                                        <span class="badge bg-warning text-dark">Supplier</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">User</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-dark edit-btn me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal" 
                                            data-id="<?php echo $u->user_id; ?>" 
                                            data-name="<?php echo htmlspecialchars($u->user_nama); ?>" 
                                            data-username="<?php echo htmlspecialchars($u->username); ?>" 
                                            data-email="<?php echo htmlspecialchars($u->user_email); ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <?php if ($u->user_id !== $_SESSION['user_id']): ?>
                                        <button class="btn btn-sm btn-outline-danger delete-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteUserModal" 
                                                data-id="<?php echo $u->user_id; ?>" 
                                                data-name="<?php echo htmlspecialchars($u->user_nama); ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addUserLabel">Add User Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/users" method="POST">
                <input type="hidden" name="action" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_role" class="form-label fw-semibold">Role</label>
                        <select class="form-select" id="add_role" name="role" required>
                            <option value="user">User</option>
                            <option value="supplier">Supplier</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add_name" class="form-label fw-semibold">Full Name</label>
                        <input type="text" class="form-control" id="add_name" name="name" required placeholder="Full Name">
                    </div>
                    <div class="mb-3">
                        <label for="add_username" class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control" id="add_username" name="username" required placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="add_email" class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control" id="add_email" name="email" required placeholder="Email Address">
                    </div>
                    <div class="mb-3">
                        <label for="add_password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" id="add_password" name="password" required placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editUserLabel">Edit User Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/users" method="POST">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold">Full Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_username" class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control" id="edit_username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label fw-semibold">New Password <span class="text-muted small fw-normal">(Leave blank to keep current)</span></label>
                        <input type="password" class="form-control" id="edit_password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-danger" id="deleteUserLabel">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/users" method="POST">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" id="delete_id">
                <div class="modal-body">
                    <p>Are you sure you want to delete user <strong id="delete_name_label"></strong>? All transaction records for this user will remain for historical bookkeeping.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Edit button handler
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('edit_id').value = btn.getAttribute('data-id');
                document.getElementById('edit_name').value = btn.getAttribute('data-name');
                document.getElementById('edit_username').value = btn.getAttribute('data-username');
                document.getElementById('edit_email').value = btn.getAttribute('data-email');
            });
        });

        // Delete button handler
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('delete_id').value = btn.getAttribute('data-id');
                document.getElementById('delete_name_label').textContent = btn.getAttribute('data-name');
            });
        });
    });
</script>