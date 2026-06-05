<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex">
    <!-- Sidebar -->
    <?php include __DIR__ . '/../layouts/sidebar_supplier.php'; ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <h3 class="fw-bold mb-4">Pending Admin Stock Requests</h3>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Pending list -->
        <?php if (empty($pending_requests)): ?>
            <div class="card p-5 text-center border-0 shadow-sm" style="border-radius: 12px;">
                <div class="py-4">
                    <i class="fa-solid fa-clipboard-check fa-3x text-muted mb-3"></i>
                    <h5>All caught up!</h5>
                    <p class="text-muted mb-0">There are no pending stock requests from the administrator at this time.</p>
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
                                    <th scope="col" class="py-3 text-center">Requested Size</th>
                                    <th scope="col" class="py-3 text-center">Quantity</th>
                                    <th scope="col" class="py-3 text-center">Status</th>
                                    <th scope="col" class="py-3 text-end pe-4" style="width: 200px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($pending_requests as $req): 
                                ?>
                                    <tr class="border-bottom">
                                        <td class="ps-4 fw-medium"><?php echo $no++; ?></td>
                                        <td>
                                            <img src="<?php echo BASE_URL; ?>assets/produk/<?php echo $req->product_image; ?>" alt="shoe" width="55" height="55" class="rounded object-fit-cover shadow-sm">
                                        </td>
                                        <td class="fw-semibold"><?php echo htmlspecialchars($req->product_name); ?></td>
                                        <td class="text-center fw-medium"><?php echo $req->size_value; ?></td>
                                        <td class="text-center fw-bold"><?php echo $req->quantity; ?> pairs</td>
                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark"><i class="fa-solid fa-hourglass-half me-1"></i> Pending</span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <form action="<?php echo BASE_URL; ?>supplier/accept_request" method="POST" class="d-inline" onsubmit="return confirm('Complete this stock delivery? Stock counts will automatically increase.')">
                                                <input type="hidden" name="request_id" value="<?php echo $req->request_id; ?>">
                                                <button type="submit" class="btn btn-sm btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                                    <i class="fa-solid fa-truck-moving me-1"></i> Deliver & Complete
                                                </button>
                                            </form>
                                        </td>
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
