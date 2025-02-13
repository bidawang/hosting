<?= $this->include('Layout/header') ?>

<!-- Hero Header Start -->
<div class="container-xxl bg-primary hero-header">
    <div class="container my-5 px-lg-5">
        <div class="row g-5">
            <div class="col-lg-6 pt-5 text-center text-lg-start">
                <h1 class="display-4 text-white mb-4 animated slideInLeft">BTS Hosting</h1>
                <p class="text-white animated slideInLeft">Memberikan paket hosting sesuai dengan keinginan anda</p>
            </div>
            <div class="col-lg-6 text-center text-lg-start">
                <img class="img-fluid animated zoomIn" src="img/hero.png" alt="Hero Image">
            </div>
        </div>
    </div>
</div>
<!-- Hero Header End -->

<script>
    function updateTotalPrice() {
        const hargaBeli = <?= $paket['harga_beli']; ?>;
        const jumlahBulan = document.getElementById('jumlah-bulan').value;
        const totalPrice = hargaBeli * jumlahBulan;
        document.getElementById('total-price').innerText = 'Rp ' + totalPrice.toLocaleString('id-ID');
    }
</script>

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
                        <h4 class="mb-4">Price per month: Rp <?= number_format($paket['harga_beli'], 0, ',', '.'); ?></h4>

                        <!-- Fitur Paket -->
                        <div class="features-list mb-4">
                            <h5 class="fw-bold mb-3">Fitur:</h5>
                            <?php 
                            $fiturList = json_decode($paket['fitur'], true); 
                            if (!empty($fiturList) && is_array($fiturList)): ?>
                                <table class="table table-borderless">
                                    <tbody>
                                        <?php foreach ($fiturList as $fitur): ?>
                                            <tr>
                                                <td class="text-end" style="width: 5%;"><i class="fa fa-check text-primary"></i></td>
                                                <td class="text-start"><?= esc($fitur); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p><i class="fa fa-times text-danger me-2"></i>No features available.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Form Confirm Purchase -->
                        <form action="<?= base_url('confirm'); ?>" method="post">
    <input type="hidden" name="paket_id" value="<?= esc($paket['id']); ?>">
    <?php $user_id = session()->get('id'); ?>
    <input type="hidden" name="user_id" value="<?= esc($user_id); ?>">

    

    <?php if ($paket['satuan_lama'] === 'bulan'): ?>
        <!-- Form Pilihan Bulan -->
        <div class="mb-3">
            <label for="jumlah-bulan" class="form-label">Pilih Jumlah Bulan:</label>
            <select id="jumlah-bulan" name="jumlah_bulan" class="form-select">
                <option value="1">1 Bulan</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="12">12 Bulan</option>
            </select>
        </div>
    <?php elseif ($paket['satuan_lama'] === 'tahun'): ?>
        <!-- Form Pilihan Tahun -->
        <div class="mb-3">
            <label for="jumlah-tahun" class="form-label">Pilih Jumlah Tahun:</label>
            <select id="jumlah-tahun" name="jumlah_tahun" class="form-select">
                <option value="1">1 Tahun</option>
                <option value="2">2 Tahun</option>
                <option value="3">3 Tahun</option>
                <option value="5">5 Tahun</option>
            </select>
        </div>
    <?php endif; ?>


                            <!-- Total Price -->
                            <h5 class="fw-bold mb-4">Total Price: <span id="total-price">Rp <?= number_format($paket['harga_beli'], 0, ',', '.'); ?></span></h5>

                            <button type="submit" class="btn btn-primary">Confirm Purchase</button>
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
<script>
    function updateTotalPrice() {
        const hargaBeli = <?= $paket['harga_beli']; ?>;
        let totalPrice = hargaBeli;

        const jumlahBulan = document.getElementById('jumlah-bulan');
        const jumlahTahun = document.getElementById('jumlah-tahun');

        if (jumlahBulan && jumlahBulan.value) {
            totalPrice = hargaBeli * parseInt(jumlahBulan.value);
        } else if (jumlahTahun && jumlahTahun.value) {
            totalPrice = hargaBeli * parseInt(jumlahTahun.value);
        }

        document.getElementById('total-price').innerText = 'Rp ' + totalPrice.toLocaleString('id-ID');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const jumlahBulan = document.getElementById('jumlah-bulan');
        const jumlahTahun = document.getElementById('jumlah-tahun');

        if (jumlahBulan) jumlahBulan.addEventListener('change', updateTotalPrice);
        if (jumlahTahun) jumlahTahun.addEventListener('change', updateTotalPrice);
    });
</script>

<?= $this->include('Layout/footer') ?>
