<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Daftar Storage </h3>
    </div>

    <!-- Button Tambah Storage -->
    <div class="mb-3">
        <a href="<?= base_url('storage/create') ?>" class="btn btn-primary">Tambah Storage</a>
    </div>

    <!-- Storage Table -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kapasitas</th>
                                <th>Satuan</th>
                                <th>Deskripsi</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($storage as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($item['kapasitas']) ?></td>
                                    <td><?= esc($item['satuan']) ?></td>
                                    <td><?= esc($item['deskripsi']) ?></td>
                                    <td><?= esc($item['created_at']) ?></td>
                                    <td><?= esc($item['updated_at']) ?></td>
                                    <td>
                                        <a href="<?= base_url('storage/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('storage/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
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
