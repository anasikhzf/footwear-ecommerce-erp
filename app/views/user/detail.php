<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/navbar_user.php'; ?>

<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>user/dashboard" class="text-decoration-none" style="color: var(--accent-color);">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>user/collection" class="text-decoration-none" style="color: var(--accent-color);">Collection</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product->sepatu_nama); ?></li>
        </ol>
    </nav>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-5">
        <!-- Image Column -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $product->sepatu_gambar; ?>" class="img-fluid w-100 object-fit-cover" alt="<?php echo $product->sepatu_nama; ?>" style="max-height: 500px;">
            </div>
        </div>

        <!-- Details Column -->
        <div class="col-md-6">
            <span class="badge bg-secondary mb-2 text-uppercase px-3 py-2"><?php echo htmlspecialchars($product->kategori_nama); ?></span>
            <h1 class="fw-bold mb-3"><?php echo htmlspecialchars($product->sepatu_nama); ?></h1>
            <h2 class="text-danger fw-bold mb-4">Rp. <?php echo number_format($product->sepatu_harga); ?></h2>
            
            <div class="mb-4">
                <h5 class="fw-bold">Description</h5>
                <div class="text-muted leading-relaxed">
                    <?php echo $product->sepatu_deskripsi; // Formatted HTML description from editor ?>
                </div>
            </div>

            <form action="<?php echo BASE_URL; ?>user/add_to_cart" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product->sepatu_id; ?>">
                
                <!-- Size Selector -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Select Size</h5>
                    <div class="row g-2">
                        <?php 
                        $anyStock = false;
                        foreach ($sizes as $s): 
                            $disabled = ($s->stok <= 0) ? 'disabled' : '';
                            if ($s->stok > 0) $anyStock = true;
                        ?>
                            <div class="col-3 col-sm-2">
                                <input type="radio" class="btn-check" name="size_id" id="size_<?php echo $s->ukuran_id; ?>" value="<?php echo $s->ukuran_id; ?>" required <?php echo $disabled; ?>>
                                <label class="btn btn-outline-dark w-100 py-2 d-flex flex-column align-items-center" for="size_<?php echo $s->ukuran_id; ?>" style="border-radius: 8px;">
                                    <span class="fw-bold"><?php echo $s->ukuran; ?></span>
                                    <span class="small <?php echo ($s->stok <= 0) ? 'text-danger' : 'text-success'; ?>" style="font-size: 0.65rem;">
                                        <?php echo ($s->stok <= 0) ? 'OOS' : $s->stok . ' Left'; ?>
                                    </span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Quantity and Add button -->
                <div class="row g-3 align-items-end mb-4">
                    <div class="col-sm-4">
                        <label for="quantity" class="form-label fw-bold">Quantity</label>
                        <input type="number" class="form-control py-2" id="quantity" name="quantity" value="1" min="1" max="10" required <?php echo !$anyStock ? 'disabled' : ''; ?>>
                    </div>
                    <div class="col-sm-8">
                        <?php if ($anyStock): ?>
                            <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                <i class="fa-solid fa-cart-plus me-2"></i> Add To Cart
                            </button>
                        <?php else: ?>
                            <button type="button" class="btn btn-secondary w-100 py-2 fw-semibold" disabled>
                                <i class="fa-solid fa-triangle-exclamation me-2"></i> Out Of Stock
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
