<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"><?= isset($subscription) ? 'Edit' : 'Tambah' ?> Subscription</h3>
    </div>
    <div class="card">
        <div class="card-body">
        <form action="<?= base_url('subscription/store') ?>" method="post">
        <?= csrf_field() ?>

                <div class="form-group">
                    <label for="id_customer">Customer</label>
                    <select name="id_customer" id="id_customer" class="form-control" required>
                        <option value="">Pilih Customer</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?= $customer['id'] ?>" <?= isset($subscription) && $subscription['id_customer'] == $customer['id'] ? 'selected' : '' ?>>
                                <?= $customer['username'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_paket_hosting">Paket Hosting</label>
                    <select name="id_paket_hosting" id="id_paket_hosting" class="form-control" required onchange="updateDurationOptions(this)">
                        <option value="">Pilih Paket Hosting</option>
                        <?php foreach ($paket_hosting as $paket): ?>
                            <option value="<?= $paket['id'] ?>" data-harga="<?= $paket['harga_beli'] ?>" data-satuan="<?= $paket['satuan_lama'] ?>" <?= isset($subscription) && $subscription['id_paket_hosting'] == $paket['id'] ? 'selected' : '' ?>>
                                <?= $paket['nama_kategori'] ?> - Rp <?= number_format($paket['harga_beli'], 0, ',', '.') ?> / <?= $paket['satuan_lama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="duration-options"></div>

                <h5 class="fw-bold mt-4">Total Price: Rp<span id="total-price">0</span></h5>
<input type="hidden" name="jumlah" id="total-harga" value="0">
                <button type="submit" class="btn btn-success"><?= isset($subscription) ? 'Update' : 'Simpan' ?></button>
                <a href="<?= base_url('subscription') ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<script>
    function updateDurationOptions(select) {
        const selectedOption = select.options[select.selectedIndex];
        const harga = parseInt(selectedOption.dataset.harga || 0);
        const satuan = selectedOption.dataset.satuan;

        let optionsHtml = '';

        if (satuan === 'bulan') {
            optionsHtml = `
                <div class="form-group mt-3">
                    <label for="jumlah-bulan">Pilih Jumlah Bulan:</label>
                    <select id="jumlah-bulan" name="jumlah_bulan" class="form-control" onchange="updateTotalPrice(${harga}, 'bulan')">
                        <option value="1">1 Bulan</option>
                        <option value="3">3 Bulan</option>
                        <option value="6">6 Bulan</option>
                        <option value="12">12 Bulan</option>
                    </select>
                </div>
            `;
        } else if (satuan === 'tahun') {
            optionsHtml = `
                <div class="form-group mt-3">
                    <label for="jumlah-tahun">Pilih Jumlah Tahun:</label>
                    <select id="jumlah-tahun" name="jumlah_tahun" class="form-control" onchange="updateTotalPrice(${harga}, 'tahun')">
                        <option value="1">1 Tahun</option>
                        <option value="2">2 Tahun</option>
                        <option value="3">3 Tahun</option>
                        <option value="5">5 Tahun</option>
                    </select>
                </div>
            `;
        }

        document.getElementById('duration-options').innerHTML = optionsHtml;
        updateTotalPrice(harga, satuan);
    }

    function updateTotalPrice(hargaBeli, satuan) {
        let totalPrice = parseInt(hargaBeli);
        const jumlahBulan = document.getElementById('jumlah-bulan');
        const jumlahTahun = document.getElementById('jumlah-tahun');

        if (satuan === 'bulan' && jumlahBulan) {
            totalPrice = hargaBeli * parseInt(jumlahBulan.value);
        } else if (satuan === 'tahun' && jumlahTahun) {
            totalPrice = hargaBeli * parseInt(jumlahTahun.value);
        }

        document.getElementById('total-price').innerText = totalPrice.toLocaleString('id-ID');
        document.getElementById('total-harga').value = totalPrice;
    }
</script>

<?= $this->endSection() ?>
