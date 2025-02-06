<?= $this->include('Layout/header') ?>

<div class="container-xxl bg-primary hero-header">
    <div class="container my-5 px-lg-5">
        <div class="row g-5 align-items-center">
            <!-- Kolom Hero Image, akan disembunyikan di perangkat mobile -->
            <div class="col-lg-6 text-center text-lg-start d-none d-lg-block">
                <img class="img-fluid animated zoomIn" src="img/hero.png" alt="Hero Image">
            </div>
            <!-- Kolom Form Register -->
            <div class="col-lg-6">
                <div class="card shadow-lg rounded-lg p-4">
                    <h2 class="text-center mb-4 text-primary">Register</h2>
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <?= implode('<br>', session()->getFlashdata('errors')) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('register'); ?>" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" required>
                        </div>
                        <div class="mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                        </div>
                        <div class="mb-3">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-3">Register</button>
                    </form>

                    <p class="text-center mt-3">Already have an account? <a href="<?= base_url('login'); ?>" class="text-primary fw-bold">Login here</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this CSS for styling to match the login page -->
<style>
    .hero-header {
        background: #007bff;
        padding: 4rem 0;
    }
    .container {
        max-width: 960px;
    }
    .card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .btn-primary {
        background-color: red;
        border: none;
        font-weight: 600;
    }
    .btn-primary:hover {
        background-color: red;
    }
    .text-primary {
        color: red !important;
    }
    .animated.zoomIn {
        animation: zoomIn 0.5s ease-in-out;
    }
    @keyframes zoomIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
    @media (max-width: 768px) {
        .hero-header {
            padding: 2rem 0;
        }

        /* Sembunyikan gambar di layar kecil */
        .d-none {
            display: none !important;
        }

        /* Form register lebih tinggi di layar kecil */
        .card {
            margin-top: 30px;
        }
    }
</style>

<?= $this->include('Layout/footer') ?>
