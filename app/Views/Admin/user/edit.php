<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Edit User</h3>
    </div>
    <form action="<?= base_url('user/update/' . $user['id']) ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= esc($user['username']) ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="<?= esc($user['nama_lengkap']) ?>">
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="<?= esc($user['tanggal_lahir']) ?>">
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="Laki-laki" <?= $user['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $user['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= esc($user['alamat']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Kota</label>
            <input type="text" name="kota" class="form-control" value="<?= esc($user['kota']) ?>">
        </div>
        <div class="form-group">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="<?= esc($user['provinsi']) ?>">
        </div>
        <div class="form-group">
            <label>Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control" value="<?= esc($user['kode_pos']) ?>">
        </div>
        <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="form-control" value="<?= esc($user['nomor_telepon']) ?>">
        </div>
        <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control">
                <option value="admin" <?= $user['level'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="customer" <?= $user['level'] === 'customer' ? 'selected' : '' ?>>Customer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update User</button>
        <a href="<?= base_url('user') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?= $this->endSection() ?>
