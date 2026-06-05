<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/navbar_user.php'; ?>

<div class="container my-5 text-center" style="max-width: 650px;">
    <div class="card p-5 shadow-sm border-0" style="border-radius: 15px;">
        <i class="fa-solid fa-circle-check fa-4x text-success mb-4"></i>
        <h2 class="fw-bold mb-2 text-success">Order Successful!</h2>
        <p class="text-muted mb-4">Thank you for your order. Your receipt details are provided below.</p>
        
        <div class="text-start border p-3 mb-4 rounded-3" style="background-color: var(--bg-primary);">
            <h6 class="fw-bold text-uppercase border-bottom pb-2 mb-3">Order #<?php echo $order->order_id; ?> Summary</h6>
            
            <div class="mb-3">
                <span class="text-muted d-block small">Recipient Name:</span>
                <span class="fw-medium"><?php echo htmlspecialchars($order->name); ?></span>
            </div>
            
            <div class="mb-3">
                <span class="text-muted d-block small">Shipping Address:</span>
                <span class="fw-medium"><?php echo htmlspecialchars($order->address); ?></span>
            </div>
            
            <div class="mb-3">
                <span class="text-muted d-block small">Phone Number:</span>
                <span class="fw-medium"><?php echo htmlspecialchars($order->phone_number); ?></span>
            </div>

            <div class="border-top pt-3 mt-3">
                <span class="text-muted mb-2 d-block small">Items Ordered:</span>
                <?php foreach ($items as $item): ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small"><?php echo htmlspecialchars($item->product_name); ?> (Size: <?php echo $item->size_value; ?>) x <?php echo $item->quantity; ?></span>
                        <span class="fw-bold text-danger small">Rp. <?php echo number_format($item->product_price * $item->quantity); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="border-top pt-3 mt-3 d-flex justify-content-between">
                <span class="fw-bold">Total Payment (Paid):</span>
                <span class="fw-bold text-danger">Rp. <?php echo number_format($order->order_total); ?></span>
            </div>
        </div>

        <div class="d-grid gap-2">
            <a href="<?php echo BASE_URL; ?>user/dashboard" class="btn btn-dark py-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                Back to Home Dashboard
            </a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
