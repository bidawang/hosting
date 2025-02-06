<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/adminassets/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/adminassets/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/adminassets/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/adminassets/assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/adminassets/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/adminassets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    
    <link rel="stylesheet" href="/adminassets/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/adminassets/assets/images/favicon.png" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="index.html"><img src="/adminassets/assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="<?= base_url('/admin/dashboard');?>"><img src="/adminassets/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/admin/dashboard')?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
              <a class="nav-link" href="<?= base_url('logout')?>">
                <span class="menu-title">Logout</span>
                <i class="fa fa-power-off menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">

        <?= $this->renderSection('content') ?>
          
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/adminassets/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/adminassets/assets/vendors/chart.js/chart.umd.js"></script>
    <script src="/adminassets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/adminassets/assets/js/off-canvas.js"></script>
    <script src="/adminassets/assets/js/misc.js"></script>
    <script src="/adminassets/assets/js/settings.js"></script>
    <script src="/adminassets/assets/js/todolist.js"></script>
    <script src="/adminassets/assets/js/jquery.cookie.js"></script>

    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/adminassets/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>