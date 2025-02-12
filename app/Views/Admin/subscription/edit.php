<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Edit Subscription</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('subscription/update/' . $subscription['id']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="id_customer">Customer</label>
                    <select name="id_customer" id="id_customer" class="form-control" required>
                        <option value="">Pilih Customer</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?= $customer['id'] ?>" <?= $subscription['id_customer'] == $customer['id'] ? 'selected' : '' ?>>
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
                            <option value="<?= $paket['id'] ?>" <?= $subscription['id_paket_hosting'] == $paket['id'] ? 'selected' : '' ?>>
                                <?= $paket['nama_kategori'] ?> - <?= $paket['kapasitas'] ?> <?= $paket['satuan'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control" required>
        <option value="">Pilih Status</option>
        <?php 
        $statusOptions = ['active', 'expired', 'pending', 'cancelled'];
        foreach ($statusOptions as $status): ?>
            <option value="<?= $status ?>" <?= $subscription['status'] == $status ? 'selected' : '' ?>>
                <?= ucfirst($status) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="expirated_date">Expired Date</label>
    <input type="date" name="expirated_date" id="expirated_date" class="form-control" 
           value="<?= esc(date('Y-m-d', strtotime($subscription['expirated_date']))) ?>" required>
</div>


                <button type="submit" class="btn btn-success">Update</button>
                <a href="<?= base_url('subscription') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
