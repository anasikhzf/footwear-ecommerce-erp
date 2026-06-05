<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex">
    <!-- Sidebar -->
    <?php include __DIR__ . '/../layouts/sidebar_admin.php'; ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">Product Management</h3>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addProductModal" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                <i class="fa-solid fa-plus me-2"></i> Add Product
            </button>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Products Table Card -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="py-3 ps-4" style="width: 60px;">No</th>
                                <th scope="col" class="py-3">Image</th>
                                <th scope="col" class="py-3">Product Name</th>
                                <th scope="col" class="py-3">Category</th>
                                <th scope="col" class="py-3">Price</th>
                                <th scope="col" class="py-3">Status</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($products as $p): 
                            ?>
                                <tr class="border-bottom">
                                    <td class="ps-4 fw-medium"><?php echo $no++; ?></td>
                                    <td>
                                        <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $p->product_image; ?>" alt="<?php echo $p->product_name; ?>" width="60" height="60" class="rounded object-fit-cover shadow-sm">
                                    </td>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($p->product_name); ?></td>
                                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($p->category_name); ?></span></td>
                                    <td class="fw-bold text-danger">Rp. <?php echo number_format($p->product_price); ?></td>
                                    <td>
                                        <?php if ($p->product_status == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-outline-primary me-2 edit-btn" 
                                                data-id="<?php echo $p->product_id; ?>" 
                                                data-name="<?php echo htmlspecialchars($p->product_name); ?>" 
                                                data-category="<?php echo $p->category_id; ?>" 
                                                data-price="<?php echo $p->product_price; ?>" 
                                                data-desc="<?php echo htmlspecialchars($p->product_description); ?>" 
                                                data-status="<?php echo $p->product_status; ?>" 
                                                data-bs-toggle="modal" data-bs-target="#editProductModal">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-btn" data-id="<?php echo $p->product_id; ?>" data-name="<?php echo htmlspecialchars($p->product_name); ?>" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addProductLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/products" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="add_name" class="form-label fw-semibold">Product Name</label>
                            <input type="text" class="form-control" id="add_name" name="name" required placeholder="e.g. Classic Derby Shoes">
                        </div>
                        <div class="col-md-6">
                            <label for="add_category_id" class="form-label fw-semibold">Category</label>
                            <select class="form-select border" id="add_category_id" name="category_id" required>
                                <option value="" disabled selected>Select Category</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat->category_id; ?>"><?php echo htmlspecialchars($cat->category_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="add_price" class="form-label fw-semibold">Price (Rp.)</label>
                            <input type="number" class="form-control" id="add_price" name="price" required min="0" placeholder="e.g. 500000">
                        </div>
                        <div class="col-md-6">
                            <label for="add_status" class="form-label fw-semibold">Status</label>
                            <select class="form-select border" id="add_status" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="add_image" class="form-label fw-semibold">Product Image</label>
                            <input type="file" class="form-control" id="add_image" name="image" required accept="image/*">
                        </div>
                        <div class="col-12">
                            <label for="add_description" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" id="add_description" name="description" rows="4" placeholder="Enter product description HTML or text" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editProductLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/products" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_name" class="form-label fw-semibold">Product Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_category_id" class="form-label fw-semibold">Category</label>
                            <select class="form-select border" id="edit_category_id" name="category_id" required>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat->category_id; ?>"><?php echo htmlspecialchars($cat->category_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_price" class="form-label fw-semibold">Price (Rp.)</label>
                            <input type="number" class="form-control" id="edit_price" name="price" required min="0">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_status" class="form-label fw-semibold">Status</label>
                            <select class="form-select border" id="edit_status" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="edit_image" class="form-label fw-semibold">Product Image <span class="text-muted small fw-normal">(Leave blank to keep current)</span></label>
                            <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label for="edit_description" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="4" required></textarea>
                        </div>
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

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-danger" id="deleteProductLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/products" method="POST">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" id="delete_id">
                <div class="modal-body">
                    <p>Are you sure you want to delete the product <strong id="delete_name_label"></strong>? All stock levels and size details will also be permanently deleted.</p>
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
                document.getElementById('edit_category_id').value = btn.getAttribute('data-category');
                document.getElementById('edit_price').value = btn.getAttribute('data-price');
                document.getElementById('edit_description').value = btn.getAttribute('data-desc');
                document.getElementById('edit_status').value = btn.getAttribute('data-status');
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
