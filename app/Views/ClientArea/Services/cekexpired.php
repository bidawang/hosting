<?= $this->include('Layout/header') ?>

<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <h3 class="mb-4">Control Panel</h3>
        <?php if ($isExpired) : ?>
            <div class="alert alert-danger">
                <h4>Halaman sudah expired</h4>
                <p>Maaf, masa berlaku subscription Anda telah habis pada <?= date('d-m-Y') ?>.</p>
                <div class="row">
                <h5 class="col-8"><?= esc($status)?></h5>
                <a href="<?= previous_url() ?>" class="btn btn-secondary col-2">Kembali</a>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-success">
                <h4>Selamat datang di halaman control panel Anda</h4>
                <p>Anda berhasil masuk ke control panel. Nikmati layanan Anda!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->include('Layout/footer') ?>
