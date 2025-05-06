<?php 
$website_title = $myHelpers->global_lib->get_option('website_title');
$social_media = $myHelpers->global_lib->get_option('social_media');
$company_tel = $myHelpers->global_lib->get_option('company_tel');
$company_email = $myHelpers->global_lib->get_option('company_email');
$site_language = $myHelpers->global_lib->get_option('site_language');
$default_language = $myHelpers->global_lib->get_option('default_language');
$website_logo = $myHelpers->global_lib->get_option('website_logo');
$website_logo_text = $myHelpers->global_lib->get_option('website_logo_text');
?>

<!-- 
    =============================================
            Theme Main Menu
    ============================================== 
    -->
    <header class="theme-main-menu menu-overlay menu-style-two sticky-menu">
        <div class="gap-fix info-row">
            <div class="d-md-flex justify-content-between">
                <div class="greetings text-center"><span class="opacity-50">Hello!!</span> <span class="fw-500">Welcome to babun.</span></div>
                <ul class="style-none d-none d-md-flex contact-info">
                    <li class="d-flex align-items-center"><img src="<?= base_url('template/babun/') ?>images/lazy.svg" data-src="<?= base_url('template/babun/') ?>images/icon/icon_14.svg" alt="" class="lazy-img icon me-2"> <a href="mailto:babuninc@company.com" class="fw-500">babuninc@company.com</a></li>
                    <li class="d-flex align-items-center"><img src="<?= base_url('template/babun/') ?>images/lazy.svg" data-src="<?= base_url('template/babun/') ?>images/icon/icon_15.svg" alt="" class="lazy-img icon me-2"> <a href="tel:+757 699-4478" class="fw-500">+757 699-4478</a></li>
                </ul>
            </div>
        </div>
        
        <div class="inner-content gap-fix">
            <div class="top-header position-relative">
                <div class="d-flex align-items-center">
                    <div class="logo order-lg-0">
                        <a href="index.html" class="d-flex align-items-center">
                            <img src="<?= base_url('template/babun/') ?>images/logo/logo_02.svg" alt="">
                        </a>
                    </div>
                    <!-- logo -->
                    <div class="right-widget order-lg-3 ms-auto">
                        <ul class="d-flex align-items-center style-none">
                            <li class="d-flex align-items-center login-btn-one me-3 me-md-0">
                                <img src="<?= base_url('template/babun/') ?>images/lazy.svg" data-src="<?= base_url('template/babun/') ?>images/icon/icon_16.svg" alt="" class="lazy-img icon me-2"> 
                                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="fw-500">Login</a>
                            </li>
                            <li class="d-none d-md-inline-block ms-3 ms-lg-5 me-3 me-lg-0">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="signup-btn-one icon-link">
                                    <span>Signup</span>
                                    <div class="icon rounded-circle d-flex align-items-center justify-content-center"><i class="bi bi-arrow-right"></i></div>
                                </a>
                            </li>
                        </ul>
                    </div> <!--/.right-widget-->
                    <nav class="navbar navbar-expand-lg p0 ms-lg-5 order-lg-2">
                        <button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav align-items-lg-center">
                                <li class="d-block d-lg-none"><div class="logo"><a href="index.html" class="d-block"><img src="<?= base_url('template/babun/') ?>images/logo/logo_02.svg" alt=""></a></div></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" aria-expanded="false">Home
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index.html" class="dropdown-item"><span>Finance</span></a></li>
                                        <li><a href="index-2.html" class="dropdown-item"><span>Business Consultancy</span></a></li>
                                        <li><a href="index-3.html" class="dropdown-item"><span>Banking</span></a></li>
                                        <li><a href="index-4.html" class="dropdown-item"><span>Payment Solution</span></a></li>
                                        <li><a href="index-5.html" class="dropdown-item"><span>Digital Agency</span></a></li>
                                        <li><a href="index-6.html" class="dropdown-item"><span>Marketing</span></a></li>
                                        <li><a href="index-7.html" class="dropdown-item"><span>Insurance</span></a></li>
                                        <li><a href="index-8.html" class="dropdown-item"><span>Insurance Two</span></a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown mega-dropdown-sm">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Pages
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="row gx-1">
                                            <div class="col-lg-4">
                                                <div class="menu-column">
                                                    <ul class="style-none mega-dropdown-list">
                                                        <li><a href="service-v1.html" class="dropdown-item"><span>Service v-1</span></a></li>
                                                        <li><a href="service-v2.html" class="dropdown-item"><span>Service v-2</span></a></li>
                                                        <li><a href="service-details.html" class="dropdown-item"><span>Service Details</span></a></li>
                                                        <li><a href="team-v1.html" class="dropdown-item"><span>Team V-1</span></a></li>
                                                        <li><a href="team-v2.html" class="dropdown-item"><span>Team V-2</span></a></li>
                                                        <li><a href="team-details.html" class="dropdown-item"><span>Team Details</span></a></li>
                                                    </ul>
                                                </div> <!--/.menu-column -->
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="menu-column">
                                                    <ul class="style-none mega-dropdown-list">
                                                        <li><a href="about-us-v1.html" class="dropdown-item"><span>About Us V-1</span></a></li>
                                                        <li><a href="about-us-v2.html" class="dropdown-item"><span>About Us V-2</span></a></li>
                                                        <li><a href="testimonial.html" class="dropdown-item"><span>Testimonial</span></a></li>
                                                        <li><a href="pricing.html" class="dropdown-item"><span>Pricing</span></a></li>
                                                        <li><a href="faq.html" class="dropdown-item"><span>FAQ’s</span></a></li>
                                                        <li><a href="404.html" class="dropdown-item"><span>404 Error</span></a></li>
                                                    </ul>
                                                </div> <!--/.menu-column -->
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="menu-column">
                                                    <ul class="style-none mega-dropdown-list">
                                                        <li><a href="project-v1.html" class="dropdown-item"><span>Project V-1</span></a></li>
                                                        <li><a href="project-v2.html" class="dropdown-item"><span>Project V-2</span></a></li>
                                                        <li><a href="project-v3.html" class="dropdown-item"><span>Project V-3</span></a></li>
                                                        <li><a href="project-details-v1.html" class="dropdown-item"><span>Project Details V-1</span></a></li>
                                                        <li><a href="project-details-v2.html" class="dropdown-item"><span>Project Details V-2</span></a></li>
                                                    </ul>
                                                </div> <!--/.menu-column -->
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" aria-expanded="false">Shop
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="shop-grid.html" class="dropdown-item"><span>Shop</span></a></li>
                                        <li><a href="shop-details.html" class="dropdown-item"><span>Shop Details</span></a></li>
                                        <li><a href="cart.html" class="dropdown-item"><span>Cart</span></a></li>
                                        <li><a href="checkout.html" class="dropdown-item"><span>Checkout</span></a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" aria-expanded="false">Blog
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="blog-v1.html" class="dropdown-item"><span>Blog List</span></a></li>
                                        <li><a href="blog-v2.html" class="dropdown-item"><span>Blog Grid</span></a></li>
                                        <li><a href="blog-details.html" class="dropdown-item"><span>Blog Details</span></a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html" role="button">Contact Us</a>
                                </li>
                                <li class="d-md-none ps-2 pe-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="signup-btn-one icon-link w-100 mt-20">
                                        <span class="flex-fill text-center">Signup</span>
                                        <div class="icon rounded-circle d-flex align-items-center justify-content-center"><i class="bi bi-arrow-right"></i></div>
                                    </a>
                                    <ul class="style-none contact-info m0 pt-30">
                                        <li class="d-flex align-items-center p0 mt-15"><img src="<?= base_url('template/babun/') ?>images/lazy.svg" data-src="<?= base_url('template/babun/') ?>images/icon/icon_14.svg" alt="" class="lazy-img icon me-2"> <a href="mailto:babuninc@company.com" class="fw-500">babuninc@company.com</a></li>
                                        <li class="d-flex align-items-center p0 mt-15"><img src="<?= base_url('template/babun/') ?>images/lazy.svg" data-src="<?= base_url('template/babun/') ?>images/icon/icon_15.svg" alt="" class="lazy-img icon me-2"> <a href="tel:+757 699-4478" class="fw-500">+757 699-4478</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div> <!--/.top-header-->
        </div> <!-- /.inner-content -->
    </header> 
    <!-- /.theme-main-menu -->