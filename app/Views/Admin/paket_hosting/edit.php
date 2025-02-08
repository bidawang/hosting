<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <h3 class="page-title">Edit Paket Hosting</h3>

    <form action="<?= base_url('paket-hosting/update/' . $paket['id']) ?>" method="post">
    <div class="form-group">
    <label for="id_kategori">Kategori</label>
    <select name="id_kategori" class="form-control" required>
        <option value="">Pilih Kategori</option>
        <?php foreach ($kategori as $kat): ?>
            <option value="<?= $kat['id'] ?>" <?= ($paket['id_kategori'] ?? '') == $kat['id'] ? 'selected' : '' ?>>
                <?= esc($kat['nama_kategori']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="id_storage">Storage</label>
    <select name="id_storage" class="form-control" required>
        <option value="">Pilih Storage</option>
        <?php foreach ($storage as $sto): ?>
            <option value="<?= $sto['id'] ?>" <?= ($paket['id_storage'] ?? '') == $sto['id'] ? 'selected' : '' ?>>
                <?= esc($sto['kapasitas']) . ' ' . esc($sto['satuan']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
        <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" value="<?= esc($paket['harga_beli']) ?>" required>
        </div>
        <div class="form-group">
            <label>Harga Perpanjangan</label>
            <input type="number" name="harga_perpanjangan" class="form-control" value="<?= esc($paket['harga_perpanjangan']) ?>" required>
        </div>
        <div class="form-group">
            <label>Lama Hosting</label>
            <input type="number" name="lama_hosting" class="form-control" value="<?= esc($paket['lama_hosting']) ?>" required>
        </div>
        <div class="form-group">
            <label>Satuan Lama (bulan/tahun)</label>
            <input type="text" name="satuan_lama" class="form-control" value="<?= esc($paket['satuan_lama']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="<?= base_url('paket-hosting') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection() ?>
