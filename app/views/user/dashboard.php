<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/navbar_user.php'; ?>

<!-- Hero Section -->
<div class="position-relative overflow-hidden mb-5" style="height: 500px;">
    <img src="<?php echo BASE_URL; ?>assets/img/main1.jpeg" alt="Hero Banner" class="w-100 h-100 object-fit-cover position-absolute top-0 start-0 z-n1" style="filter: brightness(0.65);">
    <div class="container h-100 d-flex flex-column justify-content-center text-white">
        <div class="col-lg-6">
            <span class="badge bg-danger mb-3 px-3 py-2 text-uppercase">New Summer Collection</span>
            <h1 class="display-3 fw-bold mb-3">Find Your Perfect Step</h1>
            <p class="lead mb-4">Explore our selection of premium sports, casual, and formal footwear crafted for maximum comfort and style.</p>
            <a href="<?php echo BASE_URL; ?>user/collection" class="btn btn-light btn-lg px-4 py-2 fw-semibold" style="color: var(--accent-color);">Shop Collection <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</div>

<div class="container mb-5">
    <!-- Categories Section -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Browse By Category</h2>
        <p class="text-muted">Find shoes for any occasion</p>
    </div>

    <div class="row g-4 mb-5 justify-content-center">
        <?php foreach ($categories as $cat): ?>
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 position-relative overflow-hidden group-hover" style="border-radius: 12px;">
                    <img src="<?php echo BASE_URL; ?>assets/kategori/<?php echo $cat->kategori_gambar; ?>" class="card-img-top object-fit-cover" alt="<?php echo $cat->kategori_nama; ?>" style="height: 250px; filter: brightness(0.8);">
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 text-white d-flex justify-content-between align-items-center bg-gradient-dark">
                        <div>
                            <h4 class="fw-bold mb-0"><?php echo $cat->kategori_nama; ?></h4>
                        </div>
                        <a href="<?php echo BASE_URL; ?>user/collection?category_id=<?php echo $cat->kategori_id; ?>" class="btn btn-light btn-sm rounded-circle"><i class="fa-solid fa-chevron-right text-dark"></i></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Featured Products Section -->
    <div class="d-flex justify-content-between align-items-end mb-4 mt-5">
        <div>
            <h2 class="fw-bold mb-0">Featured Products</h2>
            <p class="text-muted mb-0">Our top picks for you</p>
        </div>
        <a href="<?php echo BASE_URL; ?>user/collection" class="btn btn-outline-dark fw-medium btn-sm" style="border-color: var(--border-color); color: var(--text-color);">View All <i class="fa-solid fa-arrow-right ms-1"></i></a>
    </div>

    <div class="row g-4">
        <?php 
        $limit = 8;
        $counter = 0;
        foreach ($products as $p): 
            if ($counter >= $limit) break;
            $counter++;
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 position-relative" style="border-radius: 12px; overflow: hidden;">
                    <span class="position-absolute top-0 end-0 bg-success text-white px-3 py-1 m-3 small rounded-pill fw-semibold">New</span>
                    <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $p->sepatu_gambar; ?>" class="card-img-top object-fit-cover" alt="<?php echo $p->sepatu_nama; ?>" style="height: 240px;">
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
</div>

<!-- Footer Info Banner -->
<div class="bg-dark text-white py-5 mt-5" style="background-color: var(--sidebar-bg) !important;">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <i class="fa-solid fa-truck-fast fa-2x mb-3" style="color: var(--accent-color);"></i>
                <h5>Fast Delivery</h5>
                <p class="text-secondary small mb-0">Flat rate delivery within Jawa Timur with lightning speed.</p>
            </div>
            <div class="col-md-4">
                <i class="fa-solid fa-shield-halved fa-2x mb-3" style="color: var(--accent-color);"></i>
                <h5>Secure Payment</h5>
                <p class="text-secondary small mb-0">100% secure order transactions & manual confirmation checks.</p>
            </div>
            <div class="col-md-4">
                <i class="fa-solid fa-rotate-left fa-2x mb-3" style="color: var(--accent-color);"></i>
                <h5>Quality Guarantee</h5>
                <p class="text-secondary small mb-0">Authentic materials from direct verified supplier stocks.</p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
