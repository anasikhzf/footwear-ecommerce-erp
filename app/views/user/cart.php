<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php include __DIR__ . '/../layouts/navbar_user.php'; ?>

<!-- Temporary guest add to cart session handler -->
<?php if (isset($_SESSION['guest_cart_add'])): ?>
    <script>
        (function() {
            let cart = JSON.parse(localStorage.getItem('malshoes_cart')) || [];
            let item = <?php echo json_encode($_SESSION['guest_cart_add']); ?>;
            let existingIdx = cart.findIndex(c => c.productId === item.productId && c.sizeId === item.sizeId);
            if (existingIdx !== -1) {
                cart[existingIdx].quantity += item.quantity;
            } else {
                cart.push(item);
            }
            localStorage.setItem('malshoes_cart', JSON.stringify(cart));
            // Trigger cart count update
            window.location.reload();
        })();
    </script>
    <?php unset($_SESSION['guest_cart_add']); ?>
<?php endif; ?>

<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="fa-solid fa-cart-shopping me-2" style="color: var(--accent-color);"></i> Shopping Cart</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div id="cartContent">
        <!-- Rendered by PHP for logged in, or by JS for guests -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if (empty($cart_items)): ?>
                <div class="card p-5 text-center shadow-sm border-0" style="border-radius: 15px;">
                    <div class="py-5">
                        <i class="fa-solid fa-basket-shopping fa-4x text-muted mb-4"></i>
                        <h4 class="fw-bold">Your cart is empty!</h4>
                        <p class="text-muted">You haven't added any products to your cart yet.</p>
                        <a href="<?php echo BASE_URL; ?>user/collection" class="btn btn-dark mt-3 px-4 py-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">Browse Collection</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <!-- Items list -->
                    <div class="col-lg-8">
                        <div class="card p-3 shadow-sm border-0" style="border-radius: 15px;">
                            <div class="table-responsive">
                                <table class="table align-middle table-borderless">
                                    <thead>
                                        <tr class="text-muted border-bottom">
                                            <th scope="col" class="pb-3">Product</th>
                                            <th scope="col" class="pb-3 text-center">Size</th>
                                            <th scope="col" class="pb-3 text-center" style="width: 150px;">Quantity</th>
                                            <th scope="col" class="pb-3 text-end">Price</th>
                                            <th scope="col" class="pb-3 text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $subtotal = 0;
                                        foreach ($cart_items as $item): 
                                            $subtotal += $item->total_price;
                                        ?>
                                            <tr class="border-bottom">
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $item->product_image; ?>" alt="<?php echo $item->product_name; ?>" width="65" height="65" class="rounded me-3 object-fit-cover shadow-sm">
                                                        <div>
                                                            <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($item->product_name); ?></h6>
                                                            <span class="text-muted small">Unit Price: Rp. <?php echo number_format($item->unit_price); ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center py-3 fw-medium"><?php echo $item->size_value; ?></td>
                                                <td class="py-3">
                                                    <!-- Update Qty form -->
                                                    <form action="<?php echo BASE_URL; ?>user/cart" method="POST" class="d-flex justify-content-center">
                                                        <input type="hidden" name="cart_id" value="<?php echo $item->cart_id; ?>">
                                                        <input type="hidden" name="action" value="update">
                                                        <input type="number" name="quantity" class="form-control form-control-sm text-center" value="<?php echo $item->quantity; ?>" min="1" max="10" onchange="this.form.submit()" style="width: 70px;">
                                                    </form>
                                                </td>
                                                <td class="text-end py-3 fw-bold text-danger">Rp. <?php echo number_format($item->total_price); ?></td>
                                                <td class="text-center py-3">
                                                    <!-- Remove form -->
                                                    <form action="<?php echo BASE_URL; ?>user/cart" method="POST" onsubmit="return confirm('Remove this product from cart?')">
                                                        <input type="hidden" name="cart_id" value="<?php echo $item->cart_id; ?>">
                                                        <input type="hidden" name="action" value="remove">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle"><i class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card p-4 shadow-sm border-0" style="border-radius: 15px;">
                            <h5 class="fw-bold mb-4">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span class="fw-medium">Rp. <?php echo number_format($subtotal); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Shipping fee</span>
                                <span class="fw-medium">Rp. 10,000</span>
                            </div>
                            <hr class="text-secondary my-3">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Total Payment</span>
                                <span class="fw-bold text-danger fs-5">Rp. <?php echo number_format($subtotal + 10000); ?></span>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="<?php echo BASE_URL; ?>user/checkout" class="btn btn-dark py-2 fw-semibold" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                    Proceed to Checkout <i class="fa-solid fa-credit-card ms-2"></i>
                                </a>
                                <a href="<?php echo BASE_URL; ?>user/collection" class="btn btn-outline-secondary py-2" style="border-color: var(--border-color); color: var(--text-color);">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <!-- Guest LocalStorage Cart Holder (will be injected by script below) -->
            <div id="guestCartContainer"></div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<!-- Guest JS Cart Logic -->
<?php if (!isset($_SESSION['user_id'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cart = JSON.parse(localStorage.getItem('malshoes_cart')) || [];
        const container = document.getElementById('guestCartContainer');

        if (cart.length === 0) {
            container.innerHTML = `
                <div class="card p-5 text-center shadow-sm border-0" style="border-radius: 15px;">
                    <div class="py-5">
                        <i class="fa-solid fa-basket-shopping fa-4x text-muted mb-4"></i>
                        <h4 class="fw-bold">Your cart is empty!</h4>
                        <p class="text-muted">You haven't added any products to your cart yet.</p>
                        <a href="<?php echo BASE_URL; ?>user/collection" class="btn btn-dark mt-3 px-4 py-2" style="background-color: var(--accent-color); border-color: var(--accent-color);">Browse Collection</a>
                    </div>
                </div>
            `;
            return;
        }

        let subtotal = 0;
        let rowsHtml = '';
        
        cart.forEach((item, index) => {
            const totalPrice = item.price * item.quantity;
            subtotal += totalPrice;
            rowsHtml += `
                <tr class="border-bottom">
                    <td class="py-3">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo BASE_URL; ?>assets/produk/${item.image}" alt="${item.name}" width="65" height="65" class="rounded me-3 object-fit-cover shadow-sm">
                            <div>
                                <h6 class="fw-bold mb-1">${item.name}</h6>
                                <span class="text-muted small">Unit Price: Rp. ${item.price.toLocaleString()}</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center py-3 fw-medium">${item.size}</td>
                    <td class="py-3">
                        <div class="d-flex justify-content-center">
                            <input type="number" class="form-control form-control-sm text-center" value="${item.quantity}" min="1" max="10" style="width: 70px;" onchange="updateGuestQty(${index}, this.value)">
                        </div>
                    </td>
                    <td class="text-end py-3 fw-bold text-danger">Rp. ${totalPrice.toLocaleString()}</td>
                    <td class="text-center py-3">
                        <button onclick="removeGuestItem(${index})" class="btn btn-outline-danger btn-sm rounded-circle"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            `;
        });

        container.innerHTML = `
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card p-3 shadow-sm border-0" style="border-radius: 15px;">
                        <div class="table-responsive">
                            <table class="table align-middle table-borderless">
                                <thead>
                                    <tr class="text-muted border-bottom">
                                        <th scope="col" class="pb-3">Product</th>
                                        <th scope="col" class="pb-3 text-center">Size</th>
                                        <th scope="col" class="pb-3 text-center" style="width: 150px;">Quantity</th>
                                        <th scope="col" class="pb-3 text-end">Price</th>
                                        <th scope="col" class="pb-3 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${rowsHtml}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card p-4 shadow-sm border-0" style="border-radius: 15px;">
                        <h5 class="fw-bold mb-4">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-medium">Rp. ${subtotal.toLocaleString()}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping fee</span>
                            <span class="fw-medium">Rp. 10,000</span>
                        </div>
                        <hr class="text-secondary my-3">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total Payment</span>
                            <span class="fw-bold text-danger fs-5">Rp. ${(subtotal + 10000).toLocaleString()}</span>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="<?php echo BASE_URL; ?>user/checkout" class="btn btn-dark py-2 fw-semibold" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                Proceed to Checkout <i class="fa-solid fa-credit-card ms-2"></i>
                            </a>
                            <a href="<?php echo BASE_URL; ?>user/collection" class="btn btn-outline-secondary py-2" style="border-color: var(--border-color); color: var(--text-color);">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    window.updateGuestQty = (index, value) => {
        let cart = JSON.parse(localStorage.getItem('malshoes_cart')) || [];
        cart[index].quantity = parseInt(value);
        localStorage.setItem('malshoes_cart', JSON.stringify(cart));
        window.location.reload();
    };

    window.removeGuestItem = (index) => {
        if (confirm('Remove this product from cart?')) {
            let cart = JSON.parse(localStorage.getItem('malshoes_cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('malshoes_cart', JSON.stringify(cart));
            window.location.reload();
        }
    };
</script>
<?php endif; ?>
