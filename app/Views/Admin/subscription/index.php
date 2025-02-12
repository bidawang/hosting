<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Daftar Subscription</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url('subscription/create') ?>" class="btn btn-primary mb-3">Tambah Subscription</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Package</th>
                        <th>Status</th>
                        <th>Expired Date</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($subscriptions)): ?>
                        <?php foreach ($subscriptions as $index => $subscription): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($subscription['nama_lengkap']) ?></td>
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
                            <!-- Modal -->
    <div class="modal fade" id="detailModal<?= $subscription['id'] ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $subscription['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel<?= $subscription['id'] ?>">Detail Subscription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Customer:</strong> <?= esc($subscription['nama_lengkap']) ?></p>
                    <p><strong>Package:</strong> <?= esc($subscription['nama_kategori']) ?></p>
                    <p><strong>Status:</strong> <?= ucfirst($subscription['status']) ?></p>
                    <p><strong>Username:</strong> <?= ucfirst($subscription['username']) ?></p>
                    <p><strong>Password:</strong> <?= ucfirst($subscription['password']) ?></p>
                    <p><strong>Expired Date:</strong> <?= date('d M Y', strtotime($subscription['expirated_date'])) ?></p>
                    <p><strong>Jumlah:</strong> <?= esc($subscription['jumlah']) ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data subscription.</td>
                            <!-- cek autodeploy -->
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
