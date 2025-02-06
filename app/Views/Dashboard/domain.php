<?= $this->include('Layout/header') ?>

<div class="container-xxl bg-primary hero-header">
                <div class="container my-5 px-lg-5">
                    <div class="row g-5">
                        <div class="col-lg-6 pt-5 text-center text-lg-start">
                            <h1 class="display-4 text-white mb-4 animated slideInLeft">BTS Hosting</h1>
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


        <!-- Domain Search Start -->
        <div class="container-xxl domain" style="margin-top: 90px; margin-bottom: 90px;">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="section-title position-relative text-center mx-auto mb-4 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                            <h1 class="mb-3">Search Your Domain</h1>
                            <p class="mb-1">Vero justo sed sed vero clita amet. Et justo vero sea diam elitr amet ipsum eos ipsum clita duo sed. Sed vero sea diam erat vero elitr sit clita.</p>
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
        
        <?= $this->include('Layout/footer') ?>
