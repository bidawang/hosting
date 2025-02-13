<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Daftar Subscription</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url('subscription/create') ?>" class="btn btn-primary mb-3">Tambah Subscription</a>
            <div class="accordion" id="subscriptionAccordion">
                <?php if (!empty($subscriptions)): ?>
                    <?php 
                        $customers = [];
                        foreach ($subscriptions as $subscription) {
                            $customers[$subscription['nama_lengkap']][] = $subscription;
                        }
                        $accordionIndex = 0;
                    ?>
                    <?php foreach ($customers as $customer => $customerSubscriptions): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $accordionIndex ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $accordionIndex ?>" aria-expanded="<?= $accordionIndex === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $accordionIndex ?>">
                                    <?= esc($customer) ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $accordionIndex ?>" class="accordion-collapse collapse text-center" aria-labelledby="heading<?= $accordionIndex ?>" data-bs-parent="#subscriptionAccordion">
                                <div class="accordion-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Package</th>
                                                <th>Status</th>
                                                <th>Expired Date</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($customerSubscriptions as $index => $subscription): ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= esc($subscription['nama_kategori']) ?></td>
                                                    <td>
                                                        <form action="/subscription/updateStatus/<?= $subscription['id'] ?>" method="POST">
                                                            <select name="status" onchange="this.form.submit()" class="form-select">
                                                                <?php 
                                                                $statusOptions = ['active', 'expired', 'pending', 'cancelled'];
                                                                foreach ($statusOptions as $status): ?>
                                                                    <option value="<?= $status ?>" <?= $subscription['status'] == $status ? 'selected' : '' ?>>
                                                                        <?= ucfirst($status) ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td><?= date('d M Y', strtotime($subscription['expirated_date'])) ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $subscription['id'] ?>">
                                                            Detail
                                                        </button>
                                                        <a href="<?= base_url('subscription/edit/' . $subscription['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                        <a href="<?= base_url('subscription/delete/' . $subscription['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus subscription ini?')">Hapus</a>
                                                    </td>
                                                </tr>

                                                <!-- Modal Detail -->
                                                <div class="modal fade" id="detailModal<?= $subscription['id'] ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $subscription['id'] ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title" id="detailModalLabel<?= $subscription['id'] ?>">
                                                                    <i class="bi bi-info-circle-fill me-2"></i> Detail Subscription
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <p class="mb-1 text-muted"><strong>Customer:</strong></p>
                                                                        <p class="text-dark"><?= esc($subscription['nama_lengkap']) ?></p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="mb-1 text-muted"><strong>Package:</strong></p>
                                                                        <p class="text-dark"><?= esc($subscription['nama_kategori']) ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <p class="mb-1 text-muted"><strong>Status:</strong></p>
                                                                        <span class="badge bg-<?= $subscription['status'] === 'active' ? 'success' : ($subscription['status'] === 'expired' ? 'danger' : 'warning') ?>">
                                                                            <?= ucfirst($subscription['status']) ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="mb-1 text-muted"><strong>Expired Date:</strong></p>
                                                                        <p class="text-dark"><?= date('d M Y', strtotime($subscription['expirated_date'])) ?></p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <h6 class="text-primary"><i class="bi bi-gear-fill me-1"></i> Control Panel</h6>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <p class="mb-1 text-muted"><strong>Username:</strong></p>
                                                                        <p class="text-dark"><?= esc($subscription['username']) ?></p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="mb-1 text-muted"><strong>Password:</strong></p>
                                                                        <div class="input-group">
                                                                            <input type="password" id="password-<?= $subscription['id'] ?>" class="form-control" value="<?= esc($subscription['password']) ?>" readonly>
                                                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(<?= $subscription['id'] ?>)">
                                                                                <i class="bi bi-eye" id="icon-<?= $subscription['id'] ?>"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="bi bi-x-circle me-1"></i> Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php $accordionIndex++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Tidak ada data subscription.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(id) {
        const passwordField = document.getElementById(`password-${id}`);
        const icon = document.getElementById(`icon-${id}`);
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.replace("bi-eye", "bi-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.replace("bi-eye-slash", "bi-eye");
        }
    }
</script>

<?= $this->endSection() ?>
