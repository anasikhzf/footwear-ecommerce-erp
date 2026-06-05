<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/navbar_user.php'; ?>

<div class="container my-5">
    <div class="row">
        <!-- Sidebar filters -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card p-3 shadow-sm" style="border-radius: 12px;">
                <h5 class="fw-bold mb-3">Filters</h5>
                
                <!-- Category Filter -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Category</h6>
                    <div class="list-group list-group-flush">
                        <a href="<?php echo BASE_URL; ?>user/collection?search_query=<?php echo urlencode($search_query); ?>" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center <?php echo empty($category_id) ? 'active fw-bold text-dark' : 'text-muted'; ?>" style="background: none;">
                            <span>All Categories</span>
                        </a>
                        <?php foreach ($categories as $cat): ?>
                            <a href="<?php echo BASE_URL; ?>user/collection?category_id=<?php echo $cat->kategori_id; ?>&search_query=<?php echo urlencode($search_query); ?>" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center <?php echo ($category_id == $cat->kategori_id) ? 'active fw-bold text-dark' : 'text-muted'; ?>" style="background: none;">
                                <span><?php echo $cat->kategori_nama; ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Search Info -->
                <?php if (!empty($search_query)): ?>
                    <div class="mb-3">
                        <h6 class="fw-bold mb-2">Active Search</h6>
                        <span class="badge bg-secondary p-2 d-flex justify-content-between align-items-center">
                            "<?php echo htmlspecialchars($search_query); ?>"
                            <a href="<?php echo BASE_URL; ?>user/collection?category_id=<?php echo $category_id; ?>" class="text-white ms-2"><i class="fa-solid fa-xmark"></i></a>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Catalog list -->
        <div class="col-lg-9 col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Our Collection</h4>
                <span class="text-muted small"><?php echo count($products); ?> Products found</span>
            </div>

            <?php if (empty($products)): ?>
                <div class="text-center py-5">
                    <i class="fa-solid fa-shoe-prints fa-3x text-muted mb-3"></i>
                    <h5>No products match your filters.</h5>
                    <p class="text-muted">Try clearing search term or selecting another category.</p>
                    <a href="<?php echo BASE_URL; ?>user/collection" class="btn btn-dark mt-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">Clear Filters</a>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($products as $p): ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card h-100 shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                                <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $p->sepatu_gambar; ?>" class="card-img-top object-fit-cover" alt="<?php echo $p->sepatu_nama; ?>" style="height: 220px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <span class="text-muted small uppercase"><?php echo $p->kategori_nama; ?></span>
                                        <h5 class="card-title fw-bold mt-1 mb-2"><?php echo $p->sepatu_nama; ?></h5>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <h6 class="text-danger fw-bold mb-0">Rp. <?php echo number_format($p->sepatu_harga); ?></h6>
                                            <a href="<?php echo BASE_URL; ?>user/detail/<?php echo $p->sepatu_id; ?>" class="btn btn-sm btn-dark px-3 rounded-pill" style="background-color: var(--accent-color); border-color: var(--accent-color);">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
