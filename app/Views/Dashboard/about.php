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


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="section-title position-relative mb-4 pb-4">
                            <h1 class="mb-2">Welcome to Batuah Hosting</h1>
                        </div>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit clita duo justo magna dolore erat amet</p>
                        <div class="row g-3">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="bg-light rounded text-center p-4">
                                    <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                    <p class="mb-0">Experts</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="bg-light rounded text-center p-4">
                                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                    <p class="mb-0">Clients</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="bg-light rounded text-center p-4">
                                    <i class="fa fa-check fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                    <p class="mb-0">Projects</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="img/about.png">
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Tim Kami</h1>
                    <p class="mb-1">Vero justo sed sed vero clita amet. Et justo vero sea diam elitr amet ipsum eos
                        ipsum clita duo sed. Sed vero sea diam erat vero elitr sit clita.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item border-top border-5 border-primary rounded shadow overflow-hidden">
                            <div class="text-center p-4">
                                <img class="img-fluid rounded-circle mb-4" src="img/team-1.jpg" alt="">
                                <h5 class="fw-bold mb-1">Full Name</h5>
                                <small>Designation</small>
                            </div>
                            <div class="d-flex justify-content-center bg-primary p-3">
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item border-top border-5 border-primary rounded shadow overflow-hidden">
                            <div class="text-center p-4">
                                <img class="img-fluid rounded-circle mb-4" src="img/team-2.jpg" alt="">
                                <h5 class="fw-bold mb-1">Full Name</h5>
                                <small>Designation</small>
                            </div>
                            <div class="d-flex justify-content-center bg-primary p-3">
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item border-top border-5 border-primary rounded shadow overflow-hidden">
                            <div class="text-center p-4">
                                <img class="img-fluid rounded-circle mb-4" src="img/team-3.jpg" alt="">
                                <h5 class="fw-bold mb-1">Full Name</h5>
                                <small>Designation</small>
                            </div>
                            <div class="d-flex justify-content-center bg-primary p-3">
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="team-item border-top border-5 border-primary rounded shadow overflow-hidden">
                            <div class="text-center p-4">
                                <img class="img-fluid rounded-circle mb-4" src="img/team-4.jpg" alt="">
                                <h5 class="fw-bold mb-1">Full Name</h5>
                                <small>Designation</small>
                            </div>
                            <div class="d-flex justify-content-center bg-primary p-3">
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square text-primary bg-white m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->

        <?= $this->include('Layout/footer') ?>
