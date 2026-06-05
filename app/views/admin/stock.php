<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex">
    <!-- Sidebar -->
    <?php include __DIR__ . '/../layouts/sidebar_admin.php'; ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <h3 class="fw-bold mb-4">Stock Control</h3>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Stock levels table card -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="py-3 ps-4" style="width: 60px;">No</th>
                                <th scope="col" class="py-3">Image</th>
                                <th scope="col" class="py-3">Product Name</th>
                                <th scope="col" class="py-3">Sizes Stock Breakdown</th>
                                <th scope="col" class="py-3 text-center" style="width: 150px;">Total Stock</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $productModel = new \App\ProductModel(); // Or use dynamic size loading
                            foreach ($products as $p): 
                                // Get sizes list dynamically inside view or instantiate db helper
                                $db = new \App\Core\Database();
                                $db->query("SELECT us.stok, u.ukuran FROM ukuran_sepatu us JOIN ukuran u ON us.ukuran_id = u.ukuran_id WHERE us.sepatu_id = :pid ORDER BY u.ukuran ASC");
                                $db->bind(':pid', $p->sepatu_id);
                                $sizes = $db->resultSet();
                                
                                $totalStock = 0;
                            ?>
                                <tr class="border-bottom">
                                    <td class="ps-4 fw-medium"><?php echo $no++; ?></td>
                                    <td>
                                        <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $p->sepatu_gambar; ?>" alt="<?php echo $p->sepatu_nama; ?>" width="60" height="60" class="rounded object-fit-cover shadow-sm">
                                    </td>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($p->sepatu_nama); ?></td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php foreach ($sizes as $s): 
                                                $totalStock += $s->stok;
                                                $bgClass = ($s->stok <= 0) ? 'bg-danger' : (($s->stok < 5) ? 'bg-warning text-dark' : 'bg-success');
                                            ?>
                                                <span class="badge <?php echo $bgClass; ?>" style="font-size: 0.8rem;">
                                                    Size <?php echo $s->ukuran; ?>: <strong><?php echo $s->stok; ?></strong>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold fs-5 <?php echo ($totalStock == 0) ? 'text-danger' : (($totalStock < 15) ? 'text-warning' : 'text-success'); ?>">
                                        <?php echo $totalStock; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?php echo BASE_URL; ?>admin/request_stock/<?php echo $p->sepatu_id; ?>" class="btn btn-sm btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                            <i class="fa-solid fa-truck-ramp-box me-1"></i> Request Stock
                                        </a>
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

<?php include __DIR__ . '/../layouts/footer.php'; ?>
