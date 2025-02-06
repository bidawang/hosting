<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GreenHost - Web Hosting HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">

    <style>
        /* Sidebar Styles */
.sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #343a40;
    padding-top: 20px;
    z-index: 999;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
}

/* Sidebar hidden by default on small screens */
.sidebar.hidden {
    transform: translateX(-100%);
}

.sidebar a {
    padding: 15px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
}

.sidebar a:hover {
    background-color: #495057;
}

.sidebar .sidebar-header {
    font-size: 24px;
    color: white;
    text-align: center;
    margin-bottom: 20px;
}

/* Overlay to cover content when sidebar is open on mobile */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 998;
}

.overlay.active {
    display: block;
}

/* Toggle button for sidebar on small screens */
.sidebar-toggle {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 1000;
    background: #343a40;
    color: white;
    border: none;
    font-size: 24px;
}

/* Responsive design */


    </style>
</head>

<body>

<!-- Sidebar End -->

<!-- Overlay for Sidebar on Mobile -->
<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- Sidebar Toggle Button (for Mobile) -->
<!-- Sidebar Start -->
<aside class="sidebar hidden" id="sidebar">
    <div class="sidebar-header">Sidebar Menu</div>
    <a href="<?= base_url('/'); ?>">Home</a>
    <a href="<?= base_url('about'); ?>">About</a>
    <a href="<?= base_url('domain'); ?>">Domain</a>
    <a href="<?= base_url('hosting'); ?>">Hosting</a>
    <a href="<?= base_url('contact'); ?>">Contact</a>
</aside>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="<?php base_url('/');?>" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-server me-3"></i>Hosting BTS</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto">
        <a href="<?= base_url('/');?>" class="nav-item nav-link">Home</a>
        <a href="<?= base_url('about');?>" class="nav-item nav-link">About</a>
        <a href="<?= base_url('domain');?>" class="nav-item nav-link">Domain</a>
        <a href="<?= base_url('hosting');?>" class="nav-item nav-link">Hosting</a>
        <a href="<?= base_url('contact');?>" class="nav-item nav-link">Contact</a>
    </div>
    <?php if (session()->get('isLoggedIn')): ?>
        <a href="<?= base_url('logout') ?>" class="btn btn-danger ms-3">Logout</a>
        <button class="btn btn-success ms-3" onclick="toggleSidebar()">Client Area</button>
    <?php else: ?>
        <a href="<?= base_url('login') ?>" class="btn btn-secondary ms-3">Login</a>
    <?php endif; ?>                
</div>
</nav>
