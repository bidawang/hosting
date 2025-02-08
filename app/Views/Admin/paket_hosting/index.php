<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <h3 class="page-title">Daftar Paket Hosting</h3>
    <a href="<?= base_url('paket-hosting/create') ?>" class="btn btn-primary">Tambah Paket</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Storage</th>
                <th>Harga Beli</th>
                <th>Harga Perpanjangan</th>
                <th>Lama Hosting</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($paket_hosting as $paket): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($paket['nama_kategori']) ?></td>
                    <td><?= esc($paket['kapasitas'] . $paket['satuan']) ?></td>
                    <td><?= esc($paket['harga_beli']) ?></td>
                    <td><?= esc($paket['harga_perpanjangan']) ?></td>
                    <td><?= esc($paket['lama_hosting'] . ' ' . $paket['satuan_lama']) ?></td>
                    <td>
                        <a href="<?= base_url('paket-hosting/edit/' . $paket['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('paket-hosting/delete/' . $paket['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
