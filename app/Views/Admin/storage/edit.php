<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Edit Storage </h3>
    </div>

    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('storage/update/' . $storage['id']) ?>" method="post">
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="number" name="kapasitas" id="kapasitas" class="form-control" value="<?= esc($storage['kapasitas']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <select name="satuan" id="satuan" class="form-control" required>
                                <option value="MB" <?= $storage['satuan'] == 'MB' ? 'selected' : '' ?>>MB</option>
                                <option value="GB" <?= $storage['satuan'] == 'GB' ? 'selected' : '' ?>>GB</option>
                                <option value="TB" <?= $storage['satuan'] == 'TB' ? 'selected' : '' ?>>TB</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required><?= esc($storage['deskripsi']) ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?= base_url('storage') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
