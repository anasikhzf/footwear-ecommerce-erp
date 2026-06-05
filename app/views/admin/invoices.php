<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex">
    <!-- Sidebar -->
    <?php include __DIR__ . '/../layouts/sidebar_admin.php'; ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <h3 class="fw-bold mb-4">Supplier Invoices (Bills)</h3>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Bills Table Card -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="py-3 ps-4" style="width: 80px;">No</th>
                                <th scope="col" class="py-3">Invoice ID</th>
                                <th scope="col" class="py-3">Shoe</th>
                                <th scope="col" class="py-3 text-center">Size</th>
                                <th scope="col" class="py-3 text-center">Qty</th>
                                <th scope="col" class="py-3 text-end">Unit Price</th>
                                <th scope="col" class="py-3 text-end">Total Bill</th>
                                <th scope="col" class="py-3 text-center">Status</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($bills as $b): 
                            ?>
                                <tr class="border-bottom">
                                    <td class="ps-4 fw-medium"><?php echo $no++; ?></td>
                                    <td class="fw-bold">#TC-<?php echo $b->transaction_id; ?></td>
                                    <td><?php echo htmlspecialchars($b->sepatu_nama); ?></td>
                                    <td class="text-center"><?php echo $b->ukuran; ?></td>
                                    <td class="text-center fw-medium"><?php echo $b->quantity; ?></td>
                                    <td class="text-end text-muted small">Rp. <?php echo number_format($b->unit_price); ?></td>
                                    <td class="text-end fw-bold text-danger">Rp. <?php echo number_format($b->total_cost); ?></td>
                                    <td class="text-center">
                                        <?php if ($b->status_pembayaran === 'sudah dibayar'): ?>
                                            <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Paid</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i> Unpaid</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <?php if ($b->status_pembayaran !== 'sudah dibayar'): ?>
                                            <button class="btn btn-sm btn-dark pay-btn" 
                                                    data-id="<?php echo $b->transaction_id; ?>" 
                                                    data-cost="<?php echo $b->total_cost; ?>" 
                                                    data-bs-toggle="modal" data-bs-target="#payBillModal"
                                                    style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                                <i class="fa-solid fa-money-bill-wave me-1"></i> Pay
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                                <i class="fa-solid fa-check-double"></i> Complete
                                            </button>
                                        <?php endif; ?>
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

<!-- Pay Bill Modal -->
<div class="modal fade" id="payBillModal" tabindex="-1" aria-labelledby="payBillLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="payBillLabel">Pay Supplier Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/invoices" method="POST">
                <input type="hidden" name="transaction_id" id="pay_transaction_id">
                <div class="modal-body">
                    <p>Please confirm you are paying the exact total billing amount of <strong class="text-danger" id="pay_bill_label"></strong> for this invoice.</p>
                    <div class="mb-3">
                        <label for="amount" class="form-label fw-semibold">Payment Amount (Nominal)</label>
                        <input type="number" class="form-control" id="amount" name="amount" required placeholder="Enter exact bill amount">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">Submit Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.pay-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const cost = btn.getAttribute('data-cost');
                document.getElementById('pay_transaction_id').value = btn.getAttribute('data-id');
                document.getElementById('pay_bill_label').textContent = 'Rp. ' + parseFloat(cost).toLocaleString();
                document.getElementById('amount').value = cost; // Autofill correct amount
            });
        });
    });
</script>
