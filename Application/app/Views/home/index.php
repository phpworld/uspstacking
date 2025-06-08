<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | USPS</title>

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
    <a href="#skipallnav" class="skip-link">Skip All Utility Navigation</a>

    <!-- Top Utility Bar -->
    <div class="utility-bar bg-light py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-3">
                            <a href="#" class="text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-label="Current language: English">
                                English
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Español</a></li>
                                <li><a class="dropdown-item" href="#">Chinese</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end align-items-center utility-links">
                        <a href="#" class="text-decoration-none me-3">Locations</a>
                        <a href="#" class="text-decoration-none me-3">Support</a>
                        <a href="#" class="text-decoration-none me-3">Informed Delivery</a>
                        <a href="#" class="text-decoration-none">Register / Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header bg-white">
        <div class="container-fluid">
            <!-- Desktop Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light d-none d-lg-flex">
                <a class="navbar-brand me-4" href="#">
                    <img src="<?= base_url('/public/images/logo/usps-logo.svg') ?>" alt="Image of USPS.com logo." height="45">
                </a>

                <div class="navbar-nav flex-row">
                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="index.html">Home</a>
                    </div>

                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="about.html">About Us</a>
                    </div>

                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="send.html">SEND</a>
                    </div>

                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="receive.html">RECEIVE</a>
                    </div>

                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="faq.html">FAQ</a>
                    </div>

                    <div class="nav-item me-4">
                        <a class="nav-link fw-bold text-dark" href="<?= base_url('/tracking') ?>">Tracking</a>
                    </div>
                </div>
            </nav>

            <!-- Mobile Navigation -->
            <nav class="navbar navbar-expand-lg d-lg-none">
                <div class="d-flex align-items-center w-100">
                    <button class="navbar-toggler border-0 p-0 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
                        <img src="images/icons/hamburger.svg" alt="hamburger menu Icon" width="24" height="24">
                    </button>

                    <a class="navbar-brand mx-auto" href="#">
                        <img src="images/logo/usps-mobile-logo.svg" alt="USPS mobile logo" height="30">
                    </a>

                    <div class="d-flex">
                        <button class="btn border-0 p-0 me-2" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <img src="images/icons/search.svg" alt="Search Icon" width="24" height="24">
                        </button>
                        <a href="#" class="btn btn-link text-decoration-none">Sign In</a>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="mobileNav">
                    <div class="navbar-nav w-100 mt-3">
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="index.html">Home</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="about.html">About Us</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="send.html">SEND</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="receive.html">RECEIVE</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="faq.html">FAQ</a>
                        <a class="nav-link fw-bold text-dark py-3 border-bottom" href="<?= base_url('/tracking') ?>">Tracking</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div id="endnav"></div>
    <div id="skipallnav"></div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center" style="height: 450px;">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold text-white mb-4">Ship Online with Click-N-Ship</h1>
                        <p class="lead text-white mb-4">Ship from home in 3 easy steps. Use our online Click-N-Ship® service to pay for postage, print your own shipping labels, and schedule a free package pickup.</p>
                        <div class="d-flex gap-3 mb-4">
                            <a href="#" class="btn btn-primary btn-lg">Ship Now</a>
                            <a href="#" class="btn btn-outline-light btn-lg">Learn More</a>
                        </div>

                        <!-- Search/Track Section -->
                        <div class="search-section bg-white p-4 rounded shadow">
                            <h5 class="mb-3">Search or Track Packages</h5>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search or Enter a Tracking Number">
                                <button class="btn btn-primary" type="button">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="<?= base_url('/public/images/hero/cns-hero.jpg') ?>" alt="Click-N-Ship Service" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Tools Section -->
    <section class="quick-tools-section py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="quick-tool-card text-center p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-printer display-4 text-primary mb-3"></i>
                        <h5>Click-N-Ship®</h5>
                        <p class="text-muted">Pay for and print shipping labels.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="quick-tool-card text-center p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-postcard display-4 text-primary mb-3"></i>
                        <h5>Stamps & Supplies</h5>
                        <p class="text-muted">Forever® Stamps: $0.73<br>Postcard Stamps: $0.56</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="quick-tool-card text-center p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-envelope display-4 text-primary mb-3"></i>
                        <h5>Informed Delivery®</h5>
                        <p class="text-muted">Digitally preview your incoming mail.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="quick-tool-card text-center p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-mailbox display-4 text-primary mb-3"></i>
                        <h5>PO Boxes™</h5>
                        <p class="text-muted">Secure mail delivery at Post Office facilities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Quick Tools Grid -->
    <section class="additional-tools py-5">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="#" class="tool-link text-decoration-none">
                        <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                            <i class="bi bi-calculator text-primary me-3"></i>
                            <span>Calculate a Price</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="#" class="tool-link text-decoration-none">
                        <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                            <i class="bi bi-pause-circle text-primary me-3"></i>
                            <span>Hold Mail</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="#" class="tool-link text-decoration-none">
                        <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                            <i class="bi bi-geo-alt text-primary me-3"></i>
                            <span>ZIP Code™ Lookup</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="#" class="tool-link text-decoration-none">
                        <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                            <i class="bi bi-house text-primary me-3"></i>
                            <span>Change My Address</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Services Section -->
    <section class="featured-services py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Featured USPS® Products & Services</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="featured-card bg-white rounded shadow h-100">
                        <img src="<?= base_url('/public/images/featured/s2.webp') ?>" alt="Gift Cards" class="card-img-top">
                        <div class="card-body p-4">
                            <h4>Special Delivery for Dad</h4>
                            <p>Tuck a gift card in your Father's Day shipment. Order online early!</p>
                            <a href="#" class="btn btn-primary">Buy Gift Cards</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="featured-card bg-white rounded shadow h-100">
                        <img src="<?= base_url('/public/images/featured/chagneaddress.jpg') ?>" alt="Change of Address" class="card-img-top">
                        <div class="card-body p-4">
                            <h4>Official USPS Change of Address® Tool</h4>
                            <p>If you're moving, use our online tool to change your address: You'll need to verify your identity, pay the $1.10 identity verification fee, and complete the required form.</p>
                            <a href="#" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="featured-card bg-white rounded shadow h-100">
                        <img src="<?= base_url('/public/images/featured/PO-Box-Online-Services.jpg') ?>" alt="PO Box" class="card-img-top">
                        <div class="card-body p-4">
                            <h4>PO Box™ Online Services</h4>
                            <p>Get a PO Box to keep all your mail secure at a Post Office™ facility. Reserve and then manage your PO Box easily online with a free USPS.com account.</p>
                            <a href="#" class="btn btn-primary">Go Now for PO Box Online Services</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="featured-card bg-white rounded shadow h-100">
                        <img src="<?= base_url('/public/images/featured/Every-Door-Direct-Mail-Service.jpg') ?>" alt="Every Door Direct Mail" class="card-img-top">
                        <div class="card-body p-4">
                            <h4>Every Door Direct Mail® Service</h4>
                            <p>Sending postcards or flyers? Take out the hassle of mailing lists and addressing. Just select the mail routes you want to target and let USPS hand-deliver your mail to every door along the way.</p>
                            <a href="#" class="btn btn-primary">Learn More about Every Door Direct Mail Service</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Carousel Section -->
    <section class="product-carousel py-5">
        <div class="container">
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <img src="<?= base_url('/public/images/carousel/stamps.jpg') ?>" alt="USPS Stamps" class="img-fluid rounded">
                            </div>
                            <div class="col-md-6">
                                <h3>USPS Stamps</h3>
                                <p>Our stamps celebrate life, art, and culture. Find your favorites online.</p>
                                <p><strong>Stamp Pricing:</strong><br>Forever: <strong>$0.73</strong> | Postcard: <strong>$0.56</strong></p>
                                <a href="#" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <img src="<?= base_url('/public/images/carousel/Free-Supplies.jpg') ?>" alt="Free Supplies" class="img-fluid rounded">
                            </div>
                            <div class="col-md-6">
                                <h3>Free Supplies</h3>
                                <p>Ship with free Priority Mail® or Priority Mail Express® envelopes and boxes. Our supplies get you mailing and shipping in no time.</p>
                                <a href="#" class="btn btn-primary">Order Now for Free Supplies</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <img src="<?= base_url('/public/images/carousel/notecards.jpg') ?>" alt="Notecards" class="img-fluid rounded">
                            </div>
                            <div class="col-md-6">
                                <h3>Notecards for Spring</h3>
                                <p>Put a spring in someone's step by sending a thoughtful note with our Spring inspired notecards. Some sets include stamps.</p>
                                <a href="#" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <img src="<?= base_url('/public/images/carousel/stickers.jpg') ?>" alt="Colorful Stickers" class="img-fluid rounded">
                            </div>
                            <div class="col-md-6">
                                <h3>Colorful Stickers</h3>
                                <p>Decorate your water bottle, notebook, or laptop with these unique vinyl stickers.</p>
                                <a href="#" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- USPS Updates Section -->
    <section class="usps-updates py-5 bg-light">
        <div class="container">
            <h2 class="mb-5">USPS Updates</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="update-card bg-white p-4 rounded shadow h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                            <h5 class="mb-0">Alert: Text & Email Scams</h5>
                        </div>
                        <p>If you get a text or email claiming to be from USPS about a package awaiting action or a delivery failure, don't click it: Delete it immediately. This is an attempt to steal your personal information.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary">Text Scams</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Email Scams</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="update-card bg-white p-4 rounded shadow h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-info-circle-fill text-info me-2"></i>
                            <h5 class="mb-0">Requirements for European Union (EU) Countries</h5>
                        </div>
                        <p>Packages sent to countries that follow European Union (EU) customs rules need more-detailed content descriptions for customs forms.</p>
                        <a href="#" class="btn btn-sm btn-primary">Learn What You Need To Do</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="update-card bg-white p-4 rounded shadow h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-briefcase-fill text-success me-2"></i>
                            <h5 class="mb-0">Jobs with USPS</h5>
                        </div>
                        <p>Find nationwide opportunities to build your career while serving the American public.</p>
                        <a href="#" class="btn btn-sm btn-primary">Find Out More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <!-- Column 1: Logo & About -->
                <div class="col-lg-4 mb-4">
                    <a href="index.html" class="d-block mb-3">
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
                        <li class="mb-2"><a href="index.html" class="text-light text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="about.html" class="text-light text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="send.html" class="text-light text-decoration-none">Send</a></li>
                        <li class="mb-2"><a href="receive.html" class="text-light text-decoration-none">Receive</a></li>
                        <li class="mb-2"><a href="tracking.html" class="text-light text-decoration-none">Tracking</a></li>
                        <li class="mb-2"><a href="faq.html" class="text-light text-decoration-none">FAQ</a></li>
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

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Search USPS.com</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter search term">
                        <button class="btn btn-primary" type="button">Search</button>
                    </div>
                    <div class="mt-3">
                        <h6>Top Searches</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="btn btn-sm btn-outline-secondary">PO BOXES</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary">PASSPORTS</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary">FREE BOXES</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('/public/assets/js/main.js') ?>"></script>
    <script src="<?= base_url('/public/assets/js/carousel.js') ?>"></script>
</body>

</html>