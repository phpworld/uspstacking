<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Track Your Package | USPS') ?></title>
    <meta name="description" content="<?= esc($metaDescription ?? 'Track your USPS package with our comprehensive tracking service.') ?>">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('/public/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/public/css/responsive.css') ?>" rel="stylesheet">
</head>

<body>
    <!-- Skip Links -->
    <a href="#endnav" class="skip-link">Skip to Main Content</a>

    <!-- Top Utility Bar -->
    <div class="utility-bar bg-light py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-3">
                            <a href="#" class="text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                                English
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Español</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end align-items-center utility-links">
                        <a href="#" class="text-decoration-none me-3">Locations</a>
                        <a href="#" class="text-decoration-none me-3">Support</a>
                        <a href="#" class="text-decoration-none">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header bg-white">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light d-none d-lg-flex">
                <a class="navbar-brand me-4" href="<?= base_url('/') ?>">
                    <img src="<?= base_url('/public/images/logo/usps-logo.svg') ?>" alt="USPS Logo" height="45">
                </a>

                <div class="navbar-nav flex-row">
                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="<?= base_url('/') ?>">Home</a>
                    </div>
                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="#">About Us</a>
                    </div>
                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="#">SEND</a>
                    </div>
                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="#">RECEIVE</a>
                    </div>
                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="#">FAQ</a>
                    </div>
                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark active" href="<?= base_url('/tracking') ?>">Tracking</a>
                    </div>
                </div>
            </nav>

            <!-- Mobile Navigation -->
            <nav class="navbar navbar-expand-lg d-lg-none">
                <div class="d-flex align-items-center w-100">
                    <button class="navbar-toggler border-0 p-0 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
                        <img src="<?= base_url('/public/images/icons/hamburger.svg') ?>" alt="Menu" width="24" height="24">
                    </button>
                    <a class="navbar-brand mx-auto" href="<?= base_url('/') ?>">
                        <img src="<?= base_url('/public/images/logo/usps-mobile-logo.svg') ?>" alt="USPS" height="30">
                    </a>
                    <a href="#" class="btn btn-link text-decoration-none">Sign In</a>
                </div>

                <div class="collapse navbar-collapse" id="mobileNav">
                    <div class="navbar-nav w-100 mt-3">
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="<?= base_url('/') ?>">Home</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="#">About Us</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="#">SEND</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="#">RECEIVE</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="#">FAQ</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom active" href="<?= base_url('/tracking') ?>">Tracking</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div id="endnav"></div>

    <!-- Page Content -->
    <main class="container-fluid my-5">
        <div class="row">
            <div class="col-xl-10 col-lg-11 mx-auto">
                <!-- Hero Section -->
                <div class="tracking-hero text-center mb-5">
                    <div class="hero-content">
                        <h1 class="display-3 fw-bold text-white mb-3">
                            <i class="bi bi-box-seam me-3"></i>
                            Package Tracking
                        </h1>
                        <p class="lead text-white mb-4">Enter your tracking number to get real-time updates on your package delivery</p>
                    </div>
                </div>

                <!-- Display Flash Messages -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Modern Tracking Form -->
                <div class="tracking-form-container mb-5">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <form id="trackingForm" action="<?= base_url('/tracking') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text text-white border-0" style="background-color: #004c97;">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input type="text" class="form-control border-0 shadow-none"
                                                id="trackingNumbers" name="trackingNumbers"
                                                placeholder="Enter your tracking number here..."
                                                value="<?= esc($trackingNumber ?? '') ?>" required>
                                            <button class="btn btn-lg px-4" type="submit" style="background-color: #004c97; border-color: #004c97; color: white;">
                                                <i class="bi bi-arrow-right me-2"></i>Track Now
                                            </button>
                                        </div>
                                        <div class="form-text mt-3 text-center">
                                            <small class="text-muted">
                                                <i class="bi bi-info-circle me-1"></i>
                                                Example: 9400 1000 0000 0000 0000 00 or EA123456789US
                                            </small>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <div class="tracking-illustration">
                                        <i class="bi bi-truck display-1 text-primary opacity-75"></i>
                                        <p class="small text-muted mt-2">Fast & Reliable Tracking</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tracking Results -->
                <?php if (isset($showResults) && $showResults): ?>
                    <?php if (isset($trackingData) && $trackingData): ?>
                        <div class="tracking-results mb-5" id="trackingResults">
                            <!-- Modern Tracking Summary Header -->
                            <div class="tracking-status-card mb-4">
                                <div class="card border-0 shadow-lg">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="status-icon me-3">
                                                        <i class="bi bi-check-circle-fill text-success fs-1"></i>
                                                    </div>
                                                    <div>
                                                        <h2 class="h4 mb-1 text-dark">Package Status:
                                                            <span class="text-<?= esc($trackingData['status_class']) ?>"><?= esc($trackingData['status']) ?></span>
                                                        </h2>
                                                        <p class="text-muted mb-0"><?= esc($trackingData['service_type']) ?></p>
                                                    </div>
                                                </div>
                                                <div class="tracking-meta">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <div class="meta-item">
                                                                <i class="bi bi-hash text-primary me-2"></i>
                                                                <strong>Tracking #:</strong> <?= esc($trackingData['tracking_number']) ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="meta-item">
                                                                <i class="bi bi-calendar-check text-primary me-2"></i>
                                                                <strong>Est. Delivery:</strong> <?= esc($trackingData['delivery_date']) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <div class="status-badge-large">
                                                    <span class="badge bg-<?= esc($trackingData['status_class']) ?> fs-5 px-4 py-3 rounded-pill">
                                                        <i class="bi bi-check-circle me-2"></i><?= esc($trackingData['status']) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modern Information Cards Grid -->
                            <div class="info-cards-grid mb-5">
                                <div class="row g-4">
                                    <!-- Sender Information -->
                                    <div class="col-lg-6">
                                        <div class="info-card h-100">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-header border-0 text-white" style="background-color: #004c97;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-wrapper me-3">
                                                            <i class="bi bi-person-circle fs-4"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="mb-0">Sender Information</h5>
                                                            <small class="opacity-75">Package origin details</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-4">
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-building me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Company</small>
                                                                <span class="fw-medium"><?= esc($trackingData['sender']['company']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-person me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Contact Person</small>
                                                                <span class="fw-medium"><?= esc($trackingData['sender']['contact']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-geo-alt me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Address</small>
                                                                <span class="fw-medium"><?= nl2br(esc($trackingData['sender']['address'])) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-6">
                                                            <div class="info-item">
                                                                <div class="d-flex align-items-start">
                                                                    <i class="bi bi-telephone me-2 mt-1" style="color: #004c97;"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Phone</small>
                                                                        <span class="fw-medium small"><?= esc($trackingData['sender']['phone']) ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-item">
                                                                <div class="d-flex align-items-start">
                                                                    <i class="bi bi-envelope me-2 mt-1" style="color: #004c97;"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Email</small>
                                                                        <span class="fw-medium small"><?= esc($trackingData['sender']['email']) ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Receiver Information -->
                                    <div class="col-lg-6">
                                        <div class="info-card h-100">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-header border-0 text-white" style="background-color: #004c97;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-wrapper me-3">
                                                            <i class="bi bi-person-check fs-4"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="mb-0">Receiver Information</h5>
                                                            <small class="opacity-75">Package destination details</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-4">
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-person me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Full Name</small>
                                                                <span class="fw-medium"><?= esc($trackingData['receiver']['name']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-geo-alt me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Delivery Address</small>
                                                                <span class="fw-medium"><?= nl2br(esc($trackingData['receiver']['address'])) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-6">
                                                            <div class="info-item">
                                                                <div class="d-flex align-items-start">
                                                                    <i class="bi bi-telephone me-2 mt-1" style="color: #004c97;"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Phone</small>
                                                                        <span class="fw-medium small"><?= esc($trackingData['receiver']['phone']) ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-item">
                                                                <div class="d-flex align-items-start">
                                                                    <i class="bi bi-envelope me-2 mt-1" style="color: #004c97;"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Email</small>
                                                                        <span class="fw-medium small"><?= esc($trackingData['receiver']['email']) ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mt-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-chat-text me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Delivery Instructions</small>
                                                                <span class="fw-medium"><?= esc($trackingData['receiver']['instructions']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Parcel and Location Information Row -->
                                <div class="row g-4 mb-4">
                                    <!-- Parcel Information -->
                                    <div class="col-lg-6">
                                        <div class="info-card h-100">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-header border-0 text-white" style="background-color: #198754;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-wrapper me-3">
                                                            <i class="bi bi-box fs-4"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="mb-0">Parcel Information</h5>
                                                            <small class="opacity-75">Package details & specifications</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-4">
                                                    <div class="row g-3 mb-3">
                                                        <div class="col-6">
                                                            <div class="info-item">
                                                                <div class="d-flex align-items-start">
                                                                    <i class="bi bi-tag me-2 mt-1" style="color: #004c97;"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Type</small>
                                                                        <span class="fw-medium small"><?= esc($trackingData['parcel']['type']) ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-item">
                                                                <div class="d-flex align-items-start">
                                                                    <i class="bi bi-speedometer me-2 mt-1" style="color: #004c97;"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Weight</small>
                                                                        <span class="fw-medium small"><?= esc($trackingData['parcel']['weight']) ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-rulers me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Dimensions</small>
                                                                <span class="fw-medium"><?= esc($trackingData['parcel']['dimensions']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-list-ul me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Contents</small>
                                                                <span class="fw-medium"><?= esc($trackingData['parcel']['contents']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-4">
                                                            <div class="info-item text-center">
                                                                <i class="bi bi-currency-dollar" style="color: #004c97;"></i>
                                                                <small class="text-muted d-block">Value</small>
                                                                <span class="fw-medium small"><?= esc($trackingData['parcel']['value']) ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="info-item text-center">
                                                                <i class="bi bi-shield-check" style="color: #004c97;"></i>
                                                                <small class="text-muted d-block">Insurance</small>
                                                                <span class="fw-medium small"><?= esc($trackingData['parcel']['insurance']) ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="info-item text-center">
                                                                <i class="bi bi-stamp" style="color: #004c97;"></i>
                                                                <small class="text-muted d-block">Postage</small>
                                                                <span class="fw-medium small"><?= esc($trackingData['parcel']['postage']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mt-3 text-center">
                                                        <small class="text-muted d-block mb-2">Signature Required</small>
                                                        <?= $trackingData['parcel']['signature_required'] ? '<span class="badge bg-success px-3 py-2">Yes</span>' : '<span class="badge bg-secondary px-3 py-2">No</span>' ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Location Information -->
                                    <div class="col-lg-6">
                                        <div class="info-card h-100">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-header border-0 text-white" style="background-color: #fd7e14;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-wrapper me-3">
                                                            <i class="bi bi-geo-alt fs-4"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="mb-0">Location Information</h5>
                                                            <small class="opacity-75">Current package location</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-4">
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-pin-map me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Current Status</small>
                                                                <span class="fw-medium"><?= esc($trackingData['location']['current']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-building me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Current Facility</small>
                                                                <span class="fw-medium"><?= esc($trackingData['location']['facility']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-geo me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Facility Address</small>
                                                                <span class="fw-medium"><?= nl2br(esc($trackingData['location']['address'])) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mb-3">
                                                        <div class="col-6">
                                                            <div class="info-item">
                                                                <div class="d-flex align-items-start">
                                                                    <i class="bi bi-signpost me-2 mt-1" style="color: #004c97;"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Distance</small>
                                                                        <span class="fw-medium small"><?= esc($trackingData['location']['distance']) ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="info-item">
                                                                <div class="d-flex align-items-start">
                                                                    <i class="bi bi-mailbox me-2 mt-1" style="color: #004c97;"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Postcode</small>
                                                                        <span class="fw-medium small"><?= esc($trackingData['location']['postcode_area']) ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-truck me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Delivery Route</small>
                                                                <span class="fw-medium"><?= esc($trackingData['location']['delivery_round']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-item">
                                                        <div class="d-flex align-items-start">
                                                            <i class="bi bi-clock me-3 mt-1" style="color: #004c97;"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Last Updated</small>
                                                                <span class="fw-medium"><?= esc($trackingData['location']['last_updated']) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Section -->
                                <div class="card shadow-sm">
                                    <div class="card-header text-white" style="background-color: #004c97;">
                                        <h5 class="mb-0">
                                            <i class="bi bi-clock-history me-2"></i>
                                            Tracking Timeline
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="tracking-timeline">
                                            <?php foreach ($trackingData['timeline'] as $event): ?>
                                                <div class="timeline-item">
                                                    <div class="timeline-marker <?= esc($event['marker_class']) ?>"></div>
                                                    <div class="timeline-content">
                                                        <h6 class="mb-1"><?= esc($event['status']) ?></h6>
                                                        <p class="mb-1"><?= esc($event['description']) ?></p>
                                                        <small class="text-muted"><?= esc($event['date']) ?></small>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- No Tracking Data Found -->
                            <div class="card shadow-sm mb-5">
                                <div class="card-header bg-danger text-white">
                                    <h3 class="h5 mb-0">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        Tracking Number Not Found
                                    </h3>
                                </div>
                                <div class="card-body p-4 text-center">
                                    <i class="bi bi-search display-1 text-muted mb-3"></i>
                                    <h4>No tracking information found</h4>
                                    <p class="text-muted mb-4">
                                        The tracking number <strong><?= esc($trackingNumber ?? '') ?></strong> was not found in our system.
                                    </p>
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="alert alert-info">
                                                <h6><i class="bi bi-info-circle me-2"></i>Please check:</h6>
                                                <ul class="list-unstyled mb-0 text-start">
                                                    <li>• The tracking number is entered correctly</li>
                                                    <li>• The package has been shipped (tracking may take 24 hours to appear)</li>
                                                    <li>• The tracking number belongs to USPS</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('/tracking') ?>" class="btn btn-primary">
                                        <i class="bi bi-arrow-left me-2"></i>Try Another Tracking Number
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Tracking Tips -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body p-4">
                                    <h3 class="h5 text-primary mb-3">
                                        <i class="bi bi-lightbulb me-2"></i>
                                        Tracking Tips
                                    </h3>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Tracking numbers are case-sensitive</li>
                                        <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Remove spaces and special characters</li>
                                        <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Enter one tracking number at a time</li>
                                        <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Updates may take 24 hours to appear</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body p-4">
                                    <h3 class="h5 text-primary mb-3">
                                        <i class="bi bi-question-circle me-2"></i>
                                        Need Help?
                                    </h3>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="bi bi-arrow-right me-2"></i>View FAQs
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="bi bi-arrow-right me-2"></i>Report Missing Mail
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="bi bi-arrow-right me-2"></i>File a Claim
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="bi bi-arrow-right me-2"></i>Contact Customer Service
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alternative Tracking Methods -->
                    <div class="card shadow-sm mt-5">
                        <div class="card-header bg-info text-white">
                            <h3 class="h5 mb-0">Other Ways to Track</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-4 text-center">
                                    <i class="bi bi-phone display-6 text-primary mb-2"></i>
                                    <h6>Text Tracking</h6>
                                    <p class="small text-muted">Text your tracking number to <strong>28777 (2USPS)</strong></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <i class="bi bi-app display-6 text-primary mb-2"></i>
                                    <h6>Mobile App</h6>
                                    <p class="small text-muted">Download the official USPS Mobile app</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <i class="bi bi-envelope-open display-6 text-primary mb-2"></i>
                                    <h6>Informed Delivery®</h6>
                                    <p class="small text-muted">Get automatic email updates</p>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
            </div>
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <!-- Column 1: Logo & About -->
                <div class="col-lg-4 mb-4">
                    <a href="<?= base_url('/') ?>" class="d-block mb-3">
                        <img src="<?= base_url('/public/images/logo/usps-logo-white.svg') ?>" alt="USPS Logo" height="40">
                    </a>
                    <p class="text-light-emphasis">The United States Postal Service provides reliable, affordable, universal service to all Americans, regardless of geography.</p>
                    <div class="social-links d-flex mt-3">
                        <a href="#" class="text-light me-3" aria-label="Facebook">
                            <i class="bi bi-facebook fs-5"></i>
                        </a>
                        <a href="#" class="text-light me-3" aria-label="Instagram">
                            <i class="bi bi-instagram fs-5"></i>
                        </a>
                        <a href="#" class="text-light me-3" aria-label="Twitter">
                            <i class="bi bi-twitter-x fs-5"></i>
                        </a>
                        <a href="#" class="text-light" aria-label="YouTube">
                            <i class="bi bi-youtube fs-5"></i>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-lg-4 mb-4">
                    <h6 class="mb-3 text-white">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= base_url('/') ?>" class="text-light text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Send</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Receive</a></li>
                        <li class="mb-2"><a href="<?= base_url('/tracking') ?>" class="text-light text-decoration-none">Tracking</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact & Support -->
                <div class="col-lg-4 mb-4">
                    <h6 class="mb-3 text-white">Support</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Contact Us</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Customer Service</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Find Locations</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Careers</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Privacy Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Terms of Use</a></li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 border-secondary">

            <div class="text-center">
                <p class="mb-0 text-light-emphasis">&copy; 2024 United States Postal Service. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tracking Page Specific JS -->
    <script>
        // Auto-scroll to results if they exist
        <?php if (isset($showResults) && $showResults): ?>
            document.addEventListener('DOMContentLoaded', function() {
                const resultsElement = document.getElementById('trackingResults');
                if (resultsElement) {
                    resultsElement.scrollIntoView({
                        behavior: 'smooth'
                    });

                    // Show success message
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success alert-dismissible fade show mt-3';
                    alert.innerHTML = `
                    <i class="bi bi-check-circle me-2"></i>
                    Tracking information found! Results displayed below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                    document.getElementById('trackingForm').appendChild(alert);
                }
            });
        <?php endif; ?>
    </script>

    <style>
        /* Modern Tracking Page Styles */
        body {
            background: #f8f9fa;
            min-height: 100vh;
        }

        .tracking-hero {
            background: #004c97;
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            color: white;
        }

        .tracking-form-container .card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .tracking-form-container .input-group-lg .form-control {
            border-radius: 15px 0 0 15px;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
        }

        .tracking-form-container .btn {
            border-radius: 0 15px 15px 0;
            padding: 1rem 2rem;
        }

        .tracking-status-card .card {
            border-radius: 20px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .info-card .card {
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-card .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .info-card .card-header {
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }

        .info-item {
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(0, 123, 255, 0.05);
            border-radius: 8px;
            padding: 0.5rem;
            margin: -0.5rem;
        }

        .tracking-timeline {
            position: relative;
            padding-left: 3rem;
        }

        .tracking-timeline::before {
            content: '';
            position: absolute;
            left: 1rem;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #004c97;
            border-radius: 2px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
        }

        .timeline-marker {
            position: absolute;
            left: -2.5rem;
            top: 0.5rem;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #dee2e6;
            z-index: 2;
        }

        .timeline-content {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 1.5rem;
            border-radius: 15px;
            border-left: 4px solid #004c97;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .status-badge-large .badge {
            font-size: 1rem !important;
            padding: 1rem 2rem !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .meta-item {
            background: rgba(0, 76, 151, 0.05);
            padding: 0.75rem;
            border-radius: 10px;
            border-left: 3px solid #004c97;
        }

        .tracking-illustration i {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .tracking-hero {
                padding: 2rem 1rem;
                border-radius: 15px;
            }

            .tracking-form-container .input-group-lg .form-control,
            .tracking-form-container .btn {
                border-radius: 10px;
                margin-bottom: 0.5rem;
            }

            .info-card .card-header {
                padding: 1rem;
            }
        }

        /* Simple blue color scheme for card headers */
        .receiver-gradient {
            background: #0d6efd !important;
        }

        .parcel-gradient {
            background: #198754 !important;
        }

        .location-gradient {
            background: #fd7e14 !important;
        }

        .timeline-gradient {
            background: #6f42c1 !important;
        }
    </style>
</body>

</html>