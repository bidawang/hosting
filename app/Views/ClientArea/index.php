<?= $this->include('Layout/header') ?>

<div class="container-xxl py-5 bg-primary hero-header">
    <div class="container my-5 px-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 pt-5 text-center text-lg-start">
                <h1 class="display-4 text-white mb-4">Client Area</h1>
                <p class="text-white">Selamat datang di Client Area, kelola layanan hosting Anda dengan mudah di sini.</p>
            </div>
            <div class="col-lg-6 text-center text-lg-start">
                <img class="img-fluid animated zoomIn" src="img/client-area.png" alt="Client Area">
            </div>
        </div>
    </div>
</div>

<!-- Client Info Start -->
<div class="container-xxl py-5 ">
    <div class="container px-lg-5">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="bg-light p-4 rounded">
                    <h4 class="mb-3">Profil</h4>
                    <p><strong>Nama:</strong> <?= esc($user['nama_lengkap']) ?></p>
                    <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                    <p><strong>Status:</strong> Aktif (belum)</p>
                    <!-- <a href="#" class="btn btn-primary w-100">Edit Profil</a> -->
                </div>
            </div>
            <div class="col-lg-8 text-center">
                <div class="bg-light p-4 rounded">
                    <h4 class="mb-4">Layanan Hosting</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Layanan</th>
                                    <th>Status</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php if (!empty($subscriptions)): ?>
        <?php foreach ($subscriptions as $index => $subscription): ?>
            <tr data-bs-toggle="collapse" data-bs-target="#detail<?= $index ?>" style="cursor: pointer;">
                <td><?= $index + 1 ?></td>
                <td><?= esc($subscription['nama_kategori']) ?></td>
                <td>
                    <span class="badge <?= $subscription['status'] === 'active' ? 'bg-success' : 'bg-warning' ?>">
                        <?= ucfirst(esc($subscription['status'])) ?>
                    </span>
                </td>
                <td><?= date('d M Y', strtotime($subscription['created_at'])) ?></td>
                <td><?= date('d M Y', strtotime($subscription['expirated_date'])) ?></td>
                
            </tr>
            <tr id="detail<?= $index ?>" class="collapse">
                <td colspan="6">
                    <div class="bg-light">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= esc($subscription['username'])?></td>
                                    <td><?= esc($subscription['password'])?></td>
                                    <td>
                                    <a href="<?= base_url('/client-area/control-panel/' . $subscription['subscription_id']) ?>" class="btn btn-sm btn-secondary">
    <i class="bi bi-gear"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">Tidak ada layanan yang tersedia.</td>
        </tr>
    <?php endif; ?>
</tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Client Info End -->

<?= $this->include('Layout/footer') ?>
