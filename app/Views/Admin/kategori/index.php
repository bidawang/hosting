<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Daftar Kategori </h3>
        <a href="<?= base_url('kategori/create') ?>" class="btn btn-primary">Tambah Kategori</a>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Fitur</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($kategori as $kat): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($kat['nama_kategori']) ?></td>
                                    <td><?= esc($kat['keterangan']) ?></td>
                                    <td><pre><?= esc(json_encode($kat['fitur'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) ?></pre></td>
                                    <td>
                                        <a href="<?= base_url('kategori/edit/' . $kat['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('kategori/delete/' . $kat['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
