<?= $this->include('Layout/header') ?>

<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <h3 class="mb-4">Control Panel Settings</h3>
        <div class="row g-4">
            <!-- Data Informasi -->
            <div class="col-lg-6">
                <div class="bg-light p-4 rounded">
                    <h5 class="mb-3">Informasi Layanan</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID Subscription:</strong> <?= esc($subscription['id']) ?></li>
                        <li class="list-group-item"><strong>ID Server:</strong> <?= esc($subscription['id_server']) ?></li>
                        <li class="list-group-item"><strong>Username:</strong> <?= esc($subscription['username']) ?></li>
                    </ul>
                </div>
            </div>
<!-- Tampilkan pesan error -->

            <!-- Form Update -->
            <div class="col-lg-6">
                <div class="bg-light p-4 rounded">
                    <h5 class="mb-3">Update Username & Password</h5>
                    <form action="<?= base_url('/client-area/update-control-panel/' . $subscription['subscription_id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username Baru</label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= esc($subscription['username']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Masukkan password baru (opsional)">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Layout/footer') ?>
