<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex">
    <!-- Sidebar -->
    <?php include __DIR__ . '/../layouts/sidebar_admin.php'; ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/stock" class="text-decoration-none" style="color: var(--accent-color);">Stock Control</a></li>
                <li class="breadcrumb-item active" aria-current="page">Request Stock</li>
            </ol>
        </nav>

        <h3 class="fw-bold mb-4">Request Stock: <?php echo htmlspecialchars($product->sepatu_nama); ?></h3>

        <div class="card p-4 shadow-sm border-0" style="border-radius: 12px; max-width: 650px;">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $product->sepatu_gambar; ?>" alt="Shoe" width="90" height="90" class="rounded object-fit-cover shadow-sm me-3 border">
                <div>
                    <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($product->sepatu_nama); ?></h5>
                    <span class="badge bg-secondary"><?php echo htmlspecialchars($product->kategori_nama); ?></span>
                    <span class="text-danger fw-bold ms-2">Rp. <?php echo number_format($product->sepatu_harga); ?></span>
                </div>
            </div>

            <form action="<?php echo BASE_URL; ?>admin/request_stock/<?php echo $product->sepatu_id; ?>" method="POST">
                <p class="text-muted small mb-4"><i class="fa-solid fa-circle-info me-2 text-primary"></i> Specify the number of pairs to request from the supplier for each size below. Entering 0 will skip requesting that size.</p>

                <div class="row g-3">
                    <?php foreach ($sizes as $s): ?>
                        <div class="col-md-6 d-flex align-items-center justify-content-between border-bottom pb-2">
                            <label for="ukuran_<?php echo $s->ukuran_id; ?>" class="form-label fw-bold mb-0">
                                Size <?php echo $s->ukuran; ?> <span class="text-muted small font-normal">(Current: <?php echo $s->stok; ?>)</span>
                            </label>
                            <input type="number" class="form-control text-center" id="ukuran_<?php echo $s->ukuran_id; ?>" name="ukuran[<?php echo $s->ukuran_id; ?>]" value="0" min="0" max="100" style="width: 100px;">
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-4 pt-3 d-flex justify-content-between">
                    <a href="<?php echo BASE_URL; ?>admin/stock" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-dark px-4" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                        <i class="fa-solid fa-paper-plane me-2"></i> Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
