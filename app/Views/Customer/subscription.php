<?= $this->include('Layout/header') ?>

<div class="container-xxl bg-primary hero-header">
                <div class="container my-5 px-lg-5">
                    <div class="row g-5">
                        <div class="col-lg-6 pt-5 text-center text-lg-start">
                            <h1 class="display-4 text-white mb-4 animated slideInLeft">BTS Hosting</h1>
                            <p class="text-white animated slideInLeft">Memberikan paket hosting sesuai dengan keingian anda</p>
                            </div>
                        <div class="col-lg-6 text-center text-lg-start">
                            <img class="img-fluid animated zoomIn" src="img/hero.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
    // Toggle sidebar visibility
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        sidebar.classList.toggle('hidden');
        overlay.classList.toggle('active');
    }
</script>

        <!-- Navbar & Hero End -->
<!-- Verify Order Start -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-4">
            <h1 class="mb-3">Verify Your Order</h1>
            <p class="mb-1">Silakan periksa detail paket Anda sebelum melanjutkan pembelian.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= esc($paket['nama_kategori']); ?></h5>
                        <p class="card-text"><?= esc($paket['keterangan']); ?></p>
                        <h4 class="mb-4">Price: Rp <?= number_format($paket['harga_beli'], 0, ',', '.'); ?> / <?= esc($paket['satuan_lama']); ?></h4>
                        
                        <!-- Fitur Paket -->
                        <div class="features-list mb-4">
                            <h5 class="fw-bold">Fitur:</h5>
                            <?php 
                            // Decode fitur yang disimpan dalam format JSON
                            $fiturList = json_decode($paket['fitur'], true); 
                            if (!empty($fiturList) && is_array($fiturList)): ?>
                                <ul class="list-unstyled">
                                    <?php foreach ($fiturList as $fitur): ?>
                                        <li><i class="fa fa-check text-primary me-2"></i><?= esc($fitur); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p><i class="fa fa-times text-danger me-2"></i>No features available.</p>
                            <?php endif; ?>
                        </div>

                        <form action="<?= base_url('confirm'); ?>" method="post">
                            <input type="hidden" name="paket_id" value="<?= esc($paket['id']); ?>">

                            <!-- id customer -->
                            <?php
                                // Ambil ID user dari session
                                $user_id = session()->get('id');
                            ?>
                            <input type="hidden" name="user_id" value="<?= esc($user_id); ?>">

                            <button type="submit" class="btn btn-primary btn-lg">Confirm Purchase</button>
                        </form>
                        <div class="mt-3">
                            <a href="<?= base_url('/') ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Verify Order End -->

<?= $this->include('Layout/footer') ?>
