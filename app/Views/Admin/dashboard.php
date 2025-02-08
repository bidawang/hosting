<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Daftar Subscription </h3>
    </div>

    <!-- Recent Subscriptions Table -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer Name</th>
                                <th>Remaining Days</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($subscription as $sub): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($sub['nama_lengkap']) ?></td>
                                    <td>
                                        <?php 
                                        if ($sub['remaining_days'] > 0) {
                                            echo esc($sub['remaining_days']) . ' days remaining';
                                        } elseif ($sub['remaining_days'] < 0) {
                                            echo 'Expired';
                                        } else {
                                            echo 'Expired Today';
                                        }
                                        ?>
                                    </td>
                                    <td><?= esc($sub['expirated_date'] ?? 'Not Set') ?></td>
                                    <td>
                                        <span class="badge <?= $sub['remaining_days'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $sub['remaining_days'] > 0 ? 'Active' : 'Expired' ?>
                                        </span>
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

<script>
    // Optional: You can add chart scripts here for more dashboard functionality
</script>

<?= $this->endSection() ?>
