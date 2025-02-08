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
                        <th>Order Date</th>
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
                                    <span class="badge <?= $subscription['status'] === 'active' ? 'badge-success' : 'badge-danger' ?>">
                                        <?= ucfirst(esc($subscription['status'])) ?>
                                    </span>
                                </td>
                                <td><?= date('d M Y', strtotime($subscription['tanggal_pesan'])) ?></td>
                                <td><?= date('d M Y', strtotime($subscription['expirated_date'])) ?></td>
                                <td>
                                    <a href="<?= base_url('subscription/edit/' . $subscription['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('subscription/delete/' . $subscription['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus subscription ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data subscription.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
