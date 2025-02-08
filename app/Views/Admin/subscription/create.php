<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"><?= isset($subscription) ? 'Edit' : 'Tambah' ?> Subscription</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="<?= isset($subscription) ? base_url('subscription/update/' . $subscription['id']) : base_url('subscription/store') ?>" method="post">
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
                    <select name="id_paket_hosting" id="id_paket_hosting" class="form-control" required>
                        <option value="">Pilih Paket Hosting</option>
                        <?php foreach ($paket_hosting as $paket): ?>
                            <option value="<?= $paket['id'] ?>" <?= isset($subscription) && $subscription['id_paket_hosting'] == $paket['id'] ? 'selected' : '' ?>>
                                <?= $paket['nama_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success"><?= isset($subscription) ? 'Update' : 'Simpan' ?></button>
                <a href="<?= base_url('subscription') ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
