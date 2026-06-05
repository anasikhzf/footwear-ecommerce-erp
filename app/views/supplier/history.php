<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex">
    <!-- Sidebar -->
    <?php include __DIR__ . '/../layouts/sidebar_supplier.php'; ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <h3 class="fw-bold mb-4">Completed Stock Deliveries</h3>

        <!-- Completed list -->
        <?php if (empty($completed_requests)): ?>
            <div class="card p-5 text-center border-0 shadow-sm" style="border-radius: 12px;">
                <div class="py-4">
                    <i class="fa-solid fa-history fa-3x text-muted mb-3"></i>
                    <h5>No history found!</h5>
                    <p class="text-muted mb-0">No completed stock requests or deliveries are on file.</p>
                </div>
            </div>
        <?php else: ?>
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="py-3 ps-4" style="width: 80px;">No</th>
                                    <th scope="col" class="py-3">Image</th>
                                    <th scope="col" class="py-3">Product Name</th>
                                    <th scope="col" class="py-3 text-center">Size</th>
                                    <th scope="col" class="py-3 text-center">Quantity</th>
                                    <th scope="col" class="py-3 text-center">Status</th>
                                    <th scope="col" class="py-3 text-end pe-4">Completed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($completed_requests as $req): 
                                ?>
                                    <tr class="border-bottom">
                                        <td class="ps-4 fw-medium"><?php echo $no++; ?></td>
                                        <td>
                                            <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $req->product_image; ?>" alt="shoe" width="55" height="55" class="rounded object-fit-cover shadow-sm">
                                        </td>
                                        <td class="fw-semibold"><?php echo htmlspecialchars($req->product_name); ?></td>
                                        <td class="text-center fw-medium"><?php echo $req->size_value; ?></td>
                                        <td class="text-center"><?php echo $req->quantity; ?> pairs</td>
                                        <td class="text-center">
                                            <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Completed</span>
                                        </td>
                                        <td class="text-end pe-4 small text-muted"><?php echo date('d M Y, H:i', strtotime($req->updated_at)); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
