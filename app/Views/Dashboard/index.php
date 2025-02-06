<?= $this->include('Layout/header') ?>


<div class="container-xxl bg-primary hero-header">
                <div class="container my-5 px-lg-5">
                    <div class="row g-5">
                        <div class="col-lg-6 pt-5 text-center text-lg-start">
                            <h1 class="display-4 text-white mb-4 animated slideInLeft">Danang5 Hosting6</h1>
                            <p class="text-white animated slideInLeft">Memberikan paket hosting sesuai dengan keingian anda</p>
                            </div>
                        <div class="col-lg-6 text-center text-lg-start">
                            <img class="img-fluid animated zoomIn" src="img/hero.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
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

        <!-- Navbar & Hero End -->
        <!-- Full Screen Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content" style="background: rgba(29, 40, 51, 0.8);">
                    <div class="modal-header border-0">
                        <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <div class="input-group" style="max-width: 600px;">
                            <input type="text" class="form-control bg-transparent border-light p-3" placeholder="Type search keyword">
                            <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full Screen Search End -->

        <!-- Pricing Start -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Our Hosting Plans</h1>
            <p class="mb-1">Vero justo sed sed vero clita amet. Et justo vero sea diam elitr amet ipsum eos ipsum clita duo sed. Sed vero sea diam erat vero elitr sit clita.</p>
        </div>
        <div class="row gy-5 gx-4">
            <?php foreach ($paketHosting as $paket): ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="position-relative shadow rounded border-top border-5 border-primary">
                        <div class="d-flex align-items-center justify-content-center position-absolute top-0 start-50 translate-middle bg-primary rounded-circle" style="width: 45px; height: 45px; margin-top: -3px;">
                            <i class="fa fa-server text-white"></i>
                        </div>
                        <div class="text-center border-bottom p-4 pt-5">
                            <h4 class="fw-bold"><?= esc($paket['nama_kategori']); ?></h4>
                            <p class="mb-0"><?= esc($paket['keterangan']); ?></p>
                        </div>
                        <div class="text-center border-bottom p-4">
                            <h1 class="mb-3">
                                <small class="align-top" style="font-size: 22px; line-height: 45px;">Rp</small><?= number_format($paket['harga_beli'], 0, ',', '.'); ?><small
                                    class="align-bottom" style="font-size: 16px; line-height: 40px;">/<?= $paket['satuan_lama'];?></small>
                            </h1>

                            <?php if (session()->get('isLoggedIn')): ?>
                                <a class="btn btn-primary px-4 py-2" href="<?= base_url('/a' . $paket['id']); ?>">Buy Now</a>
                            <?php endif; ?>    
</div>
                        <div class="p-4">
                            <p class="border-bottom pb-3"><i class="fa fa-check text-primary me-3"></i><?= esc($paket['kapasitas'] . ' ' . $paket['satuan']); ?></p>
                            <?php 
                            // Decode fitur yang disimpan dalam format JSON
                            $fiturList = json_decode($paket['fitur'], true); 
                            if (!empty($fiturList) && is_array($fiturList)): ?>
                                <?php foreach ($fiturList as $fitur): ?>
                                    <p class="border-bottom pb-3">
                                        <i class="fa fa-check text-primary me-3"></i>
                                        <?= esc($fitur); ?>
                                    </p>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="border-bottom pb-3">
                                    <i class="fa fa-times text-danger me-3"></i>
                                    No features available.
                                </p>
                            <?php endif; ?>
                            <p class="mb-0"><i class="fa fa-check text-primary me-3"></i>30 Days Money Back Guarantee</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Pricing End -->

<div class="container-xxl domain mb-5" style="margin-top: 90px;">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="section-title position-relative text-center mx-auto mb-4 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                            <h1 class="mb-3">Cari Domainmu Sendiri</h1>
                        </div>
                        <div class="position-relative w-100 my-3 wow fadeInUp" data-wow-delay="0.3s">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your domain name">
                            <button type="button" class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Search</button>
                        </div>
                        <div class="row g-3 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                                <h5 class="fw-bold text-primary mb-1">.com</h5>
                                <p class="mb-0">$9.99/year</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                                <h5 class="fw-bold text-primary mb-1">.net</h5>
                                <p class="mb-0">$9.99/year</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                                <h5 class="fw-bold text-primary mb-1">.org</h5>
                                <p class="mb-0">$9.99/year</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                                <h5 class="fw-bold text-primary mb-1">.us</h5>
                                <p class="mb-0">$9.99/year</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                                <h5 class="fw-bold text-primary mb-1">.eu</h5>
                                <p class="mb-0">$9.99/year</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                                <h5 class="fw-bold text-primary mb-1">.co.uk</h5>
                                <p class="mb-0">$9.99/year</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Domain Search End -->

        <!-- Comparison Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Shared</h1>
                    <p class="mb-1">Vero justo sed sed vero clita amet. Et justo vero sea diam elitr amet ipsum eos
                        ipsum clita duo sed. Sed vero sea diam erat vero elitr sit clita.</p>
                </div>
                <div class="row g-5 comparison position-relative">
                    <div class="pe-lg-5">
                        <div class="section-title position-relative mx-auto mb-4 pb-4">
                            <h3 class="fw-bold mb-0">Shared Server</h3>
                        </div>
                        <div class="row gy-3 gx-5">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <i class="fa fa-server fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold">99.99% Uptime</h5>
                                <p>Ipsum dolor diam stet stet kasd diam sea stet sed rebum dolor ipsum</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <i class="fa fa-shield-alt fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold">100% Secured</h5>
                                <p>Ipsum dolor diam stet stet kasd diam sea stet sed rebum dolor ipsum</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <i class="fa fa-cog fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold">Control Panel</h5>
                                <p>Ipsum dolor diam stet stet kasd diam sea stet sed rebum dolor ipsum</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <i class="fa fa-headset fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold">24/7 Support</h5>
                                <p>Ipsum dolor diam stet stet kasd diam sea stet sed rebum dolor ipsum</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Comparison Start -->

<?= $this->include('Layout/footer')?>