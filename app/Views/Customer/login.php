<?= $this->include('Layout/header') ?>

<div class="container-xxl bg-primary hero-header">
    <div class="container my-5 px-lg-5">
        <div class="row g-5 align-items-center">
            <!-- Kolom Hero Image, akan disembunyikan di perangkat mobile -->
            <div class="col-lg-6 text-center text-lg-start d-none d-lg-block">
                <img class="img-fluid animated zoomIn" src="img/hero.png" alt="Hero Image">
            </div>
            <!-- Kolom Form Login -->
            <div class="col-lg-6">
                <div class="card shadow-lg rounded-lg p-4">
                    <h2 class="text-center mb-4 text-primary">Login</h2>
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <?= implode('<br>', session()->getFlashdata('errors')) ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('login'); ?>" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-3">Login</button>
                    </form>
                    <p class="mt-3 text-center">Don't have an account? <a href="<?= base_url('register'); ?>" class="text-primary fw-bold">Register here</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this CSS for better styling -->
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

        /* Form login lebih tinggi di layar kecil */
        .card {
            margin-top: 30px;
        }
    }
</style>

        </div>

        <script>
    // Toggle sidebar visibility
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        sidebar.classList.toggle('hidden');
        overlay.classList.toggle('active');
    }
</script>



<?= $this->include('Layout/footer') ?>
