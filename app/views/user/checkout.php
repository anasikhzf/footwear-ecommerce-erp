<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/navbar_user.php'; ?>

<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="fa-solid fa-credit-card me-2" style="color: var(--accent-color);"></i> Checkout</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Billing Details Form -->
        <div class="col-lg-7">
            <div class="card p-4 shadow-sm border-0" style="border-radius: 15px;">
                <h5 class="fw-bold mb-4">Shipping & Billing Information</h5>
                <form action="<?php echo BASE_URL; ?>user/checkout" method="POST" id="checkoutForm">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium">Recipient's Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter recipient's full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-medium">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="e.g. 08123456789" required>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="form-label fw-medium">Full Address Details</label>
                        <textarea class="form-control" id="address" name="address" rows="4" placeholder="Enter province, city, district, postal code, street name, and house details" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-dark py-2 px-4 fw-semibold" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                        Place Order (Confirm Payment) <i class="fa-solid fa-circle-check ms-2"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary Side -->
        <div class="col-lg-5">
            <div class="card p-4 shadow-sm border-0" style="border-radius: 15px;">
                <h5 class="fw-bold mb-3">Order Items</h5>
                <div class="mb-4" style="max-height: 250px; overflow-y: auto;">
                    <?php 
                    $subtotal = 0;
                    foreach ($cart_items as $item): 
                        $subtotal += $item->total_price;
                    ?>
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $item->product_image; ?>" alt="<?php echo $item->product_name; ?>" width="50" height="50" class="rounded me-3 object-fit-cover border shadow-sm">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-0" style="font-size: 0.9rem;"><?php echo htmlspecialchars($item->product_name); ?></h6>
                                <span class="text-muted small">Qty: <?php echo $item->quantity; ?> | Size: <?php echo $item->size_value; ?></span>
                            </div>
                            <span class="fw-bold text-danger text-end" style="font-size: 0.9rem;">Rp. <?php echo number_format($item->total_price); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <hr class="text-secondary my-3">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-medium">Rp. <?php echo number_format($subtotal); ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Shipping fee</span>
                    <span class="fw-medium">Rp. 10,000</span>
                </div>
                <hr class="text-secondary my-3">
                <div class="d-flex justify-content-between mb-0">
                    <span class="fw-bold">Total Payment</span>
                    <span class="fw-bold text-danger fs-5">Rp. <?php echo number_format($subtotal + 10000); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
