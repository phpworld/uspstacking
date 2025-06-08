<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Track Your Item | Royal Mail Group Ltd') ?></title>
    <meta name="description" content="<?= esc($metaDescription ?? 'Track your Royal Mail delivery with our tracking service.') ?>">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <!-- Skip to main content -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Header -->
    <header class="header-section">
        <!-- Top Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="<?= base_url('/') ?>">
                    <img src="<?= base_url('assets/images/logo/rmg_logo.svg') ?>" alt="Royal Mail Group" height="40">
                </a>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Main Navigation -->
                <div class="collapse navbar-collapse" id="mainNavigation">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Personal Dropdown -->
                        <li class="nav-item dropdown mega-dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" id="personalDropdown" role="button" data-bs-toggle="dropdown">
                                Personal
                            </a>
                            <div class="dropdown-menu mega-menu">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6 class="dropdown-header">Sending</h6>
                                            <a class="dropdown-item" href="#">UK delivery prices</a>
                                            <a class="dropdown-item" href="#">International delivery prices</a>
                                            <a class="dropdown-item" href="#">Return to retailers</a>
                                            <a class="dropdown-item" href="#">Same day delivery</a>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="dropdown-header">Receiving</h6>
                                            <a class="dropdown-item" href="<?= base_url('track') ?>">Tracking</a>
                                            <a class="dropdown-item" href="#">Redelivery</a>
                                            <a class="dropdown-item" href="#">Paying fees</a>
                                            <a class="dropdown-item" href="#">Redirection</a>
                                            <a class="dropdown-item" href="#">Holding mail with KeepSafe</a>
                                            <a class="dropdown-item" href="#">PO Box</a>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="promo-card">
                                                <img src="<?= base_url('assets/images/promos/nav_personal_promo_health.jpg') ?>" alt="Royal Mail Health" class="img-fluid">
                                                <h6>Royal Mail Health</h6>
                                                <p>Delivering care to your doorstep</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="quick-links">
                                                <h6 class="dropdown-header">Quick Links</h6>
                                                <a href="#" class="quick-link-item">
                                                    <i class="fas fa-paper-plane"></i> Send an item
                                                </a>
                                                <a href="#" class="quick-link-item">
                                                    <i class="fas fa-search-location"></i> Find a postcode
                                                </a>
                                                <a href="#" class="quick-link-item">
                                                    <i class="fas fa-calendar-alt"></i> Book a collection
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Business Dropdown -->
                        <li class="nav-item dropdown mega-dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" id="businessDropdown" role="button" data-bs-toggle="dropdown">
                                Business
                            </a>
                            <div class="dropdown-menu mega-menu">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6 class="dropdown-header">Shipping</h6>
                                            <a class="dropdown-item" href="#">Parcel deliveries</a>
                                            <a class="dropdown-item" href="#">Mail delivery</a>
                                            <a class="dropdown-item" href="#">UK business delivery prices</a>
                                            <a class="dropdown-item" href="#">International business shipping</a>
                                            <a class="dropdown-item" href="#">Same day delivery</a>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="dropdown-header">Receiving</h6>
                                            <a class="dropdown-item" href="<?= base_url('track') ?>">Track</a>
                                            <a class="dropdown-item" href="#">Redeliver</a>
                                            <a class="dropdown-item" href="#">Returns</a>
                                            <a class="dropdown-item" href="#">Hold my mail</a>
                                            <a class="dropdown-item" href="#">Business PO Boxes</a>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="promo-card">
                                                <img src="<?= base_url('assets/images/promos/nav_business_promos_sme.jpg') ?>" alt="Small business hub" class="img-fluid">
                                                <h6>Small business hub</h6>
                                                <p>Helping you achieve your goals</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="quick-links">
                                                <h6 class="dropdown-header">Quick Links</h6>
                                                <a href="#" class="quick-link-item">
                                                    <i class="fas fa-paper-plane"></i> Send an item
                                                </a>
                                                <a href="#" class="quick-link-item">
                                                    <i class="fas fa-search-location"></i> Find a postcode
                                                </a>
                                                <a href="#" class="quick-link-item">
                                                    <i class="fas fa-truck"></i> Track a delivery
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Stamps & supplies -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" id="stampsDropdown" role="button" data-bs-toggle="dropdown">
                                Stamps & supplies
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">1st and 2nd Class Stamps</a></li>
                                <li><a class="dropdown-item" href="#">International Postage</a></li>
                                <li><a class="dropdown-item" href="#">Special stamp issues</a></li>
                                <li><a class="dropdown-item" href="#">Subscriptions and gifts</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right side navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/login') ?>">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="#">Send an item</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Search Bar (Mobile) -->
        <div class="search-section d-lg-none">
            <div class="container">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content">
        <!-- Breadcrumb -->
        <section class="breadcrumb-section py-3 bg-light">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Track Your Item</li>
                    </ol>
                </nav>
            </div>
        </section>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <section class="py-3">
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Tracking Hero Section -->
        <section class="tracking-hero-section py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="tracking-hero-content text-center">
                            <h1 class="display-4 fw-bold mb-4">Track Your Item</h1>
                            <p class="lead mb-5">Enter your tracking number to see the latest updates on your delivery</p>

                            <!-- Tracking Form -->
                            <div class="tracking-form-card">
                                <form action="<?= base_url('track') ?>" method="post" class="tracking-form">
                                    <?= csrf_field() ?>
                                    <div class="input-group input-group-lg mb-4">
                                        <input type="text" class="form-control" name="tracking_number"
                                            placeholder="Enter your tracking number"
                                            aria-label="Tracking number"
                                            pattern="[A-Za-z0-9]{10,20}"
                                            value="<?= esc($trackingNumber ?? '') ?>"
                                            required>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search me-2"></i>Track
                                        </button>
                                    </div>
                                    <div class="tracking-examples">
                                        <small class="text-muted">
                                            Examples: RR123456789GB, CP123456789GB, EE123456789GB
                                        </small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if ($trackingData): ?>
            <!-- Print Button -->
            <button class="print-button" onclick="window.print()">
                <i class="fas fa-print me-2"></i>Print Tracking Info
            </button>

            <!-- Tracking Results Section -->
            <section class="tracking-results-section py-5" id="trackingResults">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <!-- Tracking Summary Card -->
                            <div class="tracking-summary-card mb-4">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h3 class="card-title mb-2">Tracking Number: <?= esc($trackingData['tracking_number']) ?></h3>
                                                <p class="card-text mb-2">
                                                    <strong>Status: </strong>
                                                    <span class="badge bg-<?= esc($trackingData['status_class']) ?>"><?= esc($trackingData['status']) ?></span>
                                                </p>
                                                <p class="card-text mb-2">
                                                    <strong>Estimated Delivery: </strong>
                                                    <span><?= esc($trackingData['estimated_delivery']) ?></span>
                                                </p>
                                                <p class="card-text mb-0">
                                                    <strong>Service Type: </strong>
                                                    <span><?= esc($trackingData['service_type']) ?></span>
                                                </p>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <div class="tracking-icon">
                                                    <i class="fas fa-truck fa-3x text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detailed Information Cards -->
                            <div class="row g-4 mb-4">
                                <!-- Sender Information -->
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-user-tie me-2 text-primary"></i>Sender Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="sender-info">
                                                <div class="info-row">
                                                    <span class="info-label">Company Name:</span>
                                                    <span class="info-value"><?= esc($trackingData['sender']['company']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Contact Person:</span>
                                                    <span class="info-value"><?= esc($trackingData['sender']['contact']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Address:</span>
                                                    <span class="info-value"><?= nl2br(esc($trackingData['sender']['address'])) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Phone:</span>
                                                    <span class="info-value"><?= esc($trackingData['sender']['phone']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Email:</span>
                                                    <span class="info-value"><?= esc($trackingData['sender']['email']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Reference:</span>
                                                    <span class="info-value"><?= esc($trackingData['sender']['reference']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Receiver Information -->
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-user me-2 text-success"></i>Receiver Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="receiver-info">
                                                <div class="info-row">
                                                    <span class="info-label">Full Name:</span>
                                                    <span class="info-value"><?= esc($trackingData['receiver']['name']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Title:</span>
                                                    <span class="info-value"><?= esc($trackingData['receiver']['title']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Delivery Address:</span>
                                                    <span class="info-value"><?= nl2br(esc($trackingData['receiver']['address'])) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Phone:</span>
                                                    <span class="info-value"><?= esc($trackingData['receiver']['phone']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Email:</span>
                                                    <span class="info-value"><?= esc($trackingData['receiver']['email']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Special Instructions:</span>
                                                    <span class="info-value"><?= esc($trackingData['receiver']['instructions']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Parcel Details and Location -->
                            <div class="row g-4 mb-4">
                                <!-- Parcel Information -->
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-box me-2 text-warning"></i>Parcel Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="parcel-info">
                                                <div class="info-row">
                                                    <span class="info-label">Parcel Type:</span>
                                                    <span class="info-value"><?= esc($trackingData['parcel']['type']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Weight:</span>
                                                    <span class="info-value"><?= esc($trackingData['parcel']['weight']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Dimensions:</span>
                                                    <span class="info-value"><?= esc($trackingData['parcel']['dimensions']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Contents:</span>
                                                    <span class="info-value"><?= esc($trackingData['parcel']['contents']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Value:</span>
                                                    <span class="info-value"><?= esc($trackingData['parcel']['value']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Insurance:</span>
                                                    <span class="info-value"><?= esc($trackingData['parcel']['insurance']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Postage Cost:</span>
                                                    <span class="info-value"><?= esc($trackingData['parcel']['postage']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Signature Required:</span>
                                                    <span class="info-value">
                                                        <?= $trackingData['parcel']['signature_required'] ? 'Yes' : 'No' ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Current Location -->
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2 text-danger"></i>Current Location</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="location-info">
                                                <div class="info-row">
                                                    <span class="info-label">Current Status:</span>
                                                    <span class="info-value"><?= esc($trackingData['location']['current']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Facility:</span>
                                                    <span class="info-value"><?= esc($trackingData['location']['facility']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Address:</span>
                                                    <span class="info-value"><?= nl2br(esc($trackingData['location']['address'])) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Distance:</span>
                                                    <span class="info-value"><?= esc($trackingData['location']['distance']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Postcode Area:</span>
                                                    <span class="info-value"><?= esc($trackingData['location']['postcode_area']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Delivery Round:</span>
                                                    <span class="info-value"><?= esc($trackingData['location']['delivery_round']) ?></span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Last Updated:</span>
                                                    <span class="info-value"><?= esc($trackingData['location']['last_updated']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tracking Timeline -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-history me-2 text-info"></i>Tracking Timeline</h5>
                                </div>
                                <div class="card-body">
                                    <div class="tracking-timeline">
                                        <?php foreach ($trackingData['timeline'] as $index => $event): ?>
                                            <div class="timeline-item <?= $index === 0 ? 'active' : '' ?>">
                                                <div class="timeline-marker">
                                                    <i class="<?= esc($event['icon']) ?> text-<?= esc($event['color']) ?>"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h6 class="timeline-title"><?= esc($event['status']) ?></h6>
                                                    <p class="timeline-description"><?= esc($event['description']) ?></p>
                                                    <div class="timeline-meta">
                                                        <span class="timeline-date">
                                                            <i class="fas fa-clock me-1"></i><?= esc($event['date']) ?>
                                                        </span>
                                                        <span class="timeline-location">
                                                            <i class="fas fa-map-marker-alt me-1"></i><?= esc($event['location']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Help Section -->
        <section class="help-section py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">Need help with your delivery?</h2>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="help-card text-center">
                            <i class="fas fa-redo-alt fa-3x text-primary mb-3"></i>
                            <h5>Redeliver</h5>
                            <p>Missed your delivery? Arrange a redelivery at a time that suits you.</p>
                            <a href="#" class="btn btn-outline-primary">Arrange redelivery</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="help-card text-center">
                            <i class="fas fa-store fa-3x text-success mb-3"></i>
                            <h5>Collect from Post Office</h5>
                            <p>Pick up your item from your local Post Office at your convenience.</p>
                            <a href="#" class="btn btn-outline-success">Find Post Office</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="help-card text-center">
                            <i class="fas fa-headset fa-3x text-info mb-3"></i>
                            <h5>Contact Support</h5>
                            <p>Need more help? Our customer service team is here to assist you.</p>
                            <a href="#" class="btn btn-outline-info">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer-section bg-dark text-light py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Tools -->
                <div class="col-lg-3 col-md-6">
                    <h5>Tools</h5>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('track') ?>">Track your item</a></li>
                        <li><a href="#">Postcode finder</a></li>
                        <li><a href="#">Price finder</a></li>
                        <li><a href="#">Online postage</a></li>
                        <li><a href="#">Book a Redelivery</a></li>
                        <li><a href="#">Get the Royal Mail App</a></li>
                    </ul>
                </div>

                <!-- Help and info -->
                <div class="col-lg-3 col-md-6">
                    <h5>Help and info</h5>
                    <ul class="footer-links">
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Help and support</a></li>
                        <li><a href="#">Collect a missed delivery</a></li>
                        <li><a href="#">I think my mail is lost</a></li>
                        <li><a href="#">Service updates</a></li>
                        <li><a href="#">How to make a claim</a></li>
                        <li><a href="#">Sustainability</a></li>
                        <li><a href="#">Dog Awareness</a></li>
                        <li><a href="#">The future of letter deliveries</a></li>
                        <li><a href="#">Scam guidance</a></li>
                    </ul>
                </div>

                <!-- Mail -->
                <div class="col-lg-3 col-md-6">
                    <h5>Mail</h5>
                    <ul class="footer-links">
                        <li><a href="#">UK services</a></li>
                        <li><a href="#">International services</a></li>
                        <li><a href="#">The Stamp Hub</a></li>
                        <li><a href="#">Our prices</a></li>
                        <li><a href="#">Redirect your mail</a></li>
                    </ul>
                </div>

                <!-- Our partners -->
                <div class="col-lg-3 col-md-6">
                    <h5>Our partners</h5>
                    <ul class="footer-links">
                        <li><a href="#">Parcelforce Worldwide</a></li>
                        <li><a href="#">Stamp retailers</a></li>
                        <li><a href="#">British Heart Foundation</a></li>
                        <li><a href="#">Keep Me Posted</a></li>
                    </ul>
                </div>
            </div>

            <!-- Social Links -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="social-links text-center">
                        <h5>Royal Mail social links</h5>
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="row mt-5 pt-4 border-top">
                <div class="col-md-6">
                    <div class="safe-space">
                        <img src="<?= base_url('assets/images/footer/SafeSpace-logo.png') ?>" alt="Together we will end domestic abuse" height="30">
                        <p class="mt-2">Together we can end domestic abuse</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="footer-bottom-links">
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">International Distribution Services</a></li>
                        <li><a href="#">Terms and conditions</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms of use</a></li>
                        <li><a href="#">Cookies</a></li>
                        <li><a href="#">Accessibility</a></li>
                        <li><a href="#">Cymraeg</a></li>
                    </ul>
                    <p class="copyright mt-3">© Royal Mail Group Limited 2025</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>

</html>