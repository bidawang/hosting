<?= $this->include('Layout/header') ?>

<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <h3 class="mb-4">Control Panel Settings</h3>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php elseif (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
        
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
                <button class="btn btn-primary w-100 my-4 p-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </div>

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
                            <input type="text" class="form-control" id="password" name="password" 
                                   placeholder="Masukkan password baru">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pop-Up Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to Control Panel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/client-area/login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="loginUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="loginUsername" name="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Layout/footer') ?>
