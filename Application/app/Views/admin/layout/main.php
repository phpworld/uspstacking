<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Admin Panel') ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom Admin CSS -->
    <link href="<?= base_url('assets/css/admin.css') ?>" rel="stylesheet">
</head>

<body class="admin-panel">
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-cogs"></i> Admin Panel</h4>
        </div>

        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= (current_url() === base_url('admin') || current_url() === base_url('admin/dashboard')) ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos(current_url(), 'admin/tracking') !== false) ? 'active' : '' ?>" href="<?= base_url('admin/tracking') ?>">
                        <i class="fas fa-shipping-fast me-2"></i> Tracking Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos(current_url(), 'admin/users') !== false) ? 'active' : '' ?>" href="<?= base_url('admin/users') ?>">
                        <i class="fas fa-users me-2"></i> Admin Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos(current_url(), 'admin/settings') !== false) ? 'active' : '' ?>" href="<?= base_url('admin/settings') ?>">
                        <i class="fas fa-cog me-2"></i> Settings
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link" href="<?= base_url('admin/logout') ?>">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar d-flex justify-content-between align-items-center">
            <div>
                <button class="btn btn-link d-md-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <?php if (isset($breadcrumbs) && !empty($breadcrumbs)): ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <?php foreach ($breadcrumbs as $breadcrumb): ?>
                                <li class="breadcrumb-item <?= isset($breadcrumb['active']) && $breadcrumb['active'] ? 'active' : '' ?>">
                                    <?php if (isset($breadcrumb['active']) && $breadcrumb['active']): ?>
                                        <?= esc($breadcrumb['title']) ?>
                                    <?php else: ?>
                                        <a href="<?= base_url($breadcrumb['url']) ?>"><?= esc($breadcrumb['title']) ?></a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </nav>
                <?php endif; ?>
            </div>

            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-2"></i>
                    <?= esc($currentAdmin['first_name'] ?? 'Admin') ?> <?= esc($currentAdmin['last_name'] ?? '') ?>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('admin/users/edit/' . ($currentAdmin['id'] ?? '')) ?>">
                            <i class="fas fa-user me-2"></i> Profile
                        </a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url('admin/logout') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a></li>
                </ul>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('warning')): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= session()->getFlashdata('warning') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <?= $content ?? '' ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Admin JS -->
    <script src="<?= base_url('assets/js/admin.js') ?>"></script>
</body>

</html>