<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </h1>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Admin Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $stats['total_admins'] ?? 0 ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Active Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $stats['active_admins'] ?? 0 ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Recent Logins (24h)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $stats['recent_logins'] ?? 0 ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            System Uptime
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $stats['system_uptime'] ?? 'N/A' ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-server fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Activity -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-history me-2"></i>Recent Activity
                </h6>
            </div>
            <div class="card-body">
                <?php if (!empty($recentActivity)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recentActivity as $activity): ?>
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="<?= $activity['icon'] ?> text-<?= $activity['color'] ?>"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold"><?= esc($activity['message']) ?></div>
                                        <small class="text-muted">
                                            <?= date('M j, Y g:i A', strtotime($activity['timestamp'])) ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No recent activity to display.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- System Information -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle me-2"></i>System Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-0">
                    <div class="col-12 mb-3">
                        <small class="text-muted">PHP Version</small>
                        <div class="fw-bold"><?= esc($systemInfo['php_version'] ?? 'Unknown') ?></div>
                    </div>
                    <div class="col-12 mb-3">
                        <small class="text-muted">CodeIgniter Version</small>
                        <div class="fw-bold"><?= esc($systemInfo['codeigniter_version'] ?? 'Unknown') ?></div>
                    </div>
                    <div class="col-12 mb-3">
                        <small class="text-muted">Database Version</small>
                        <div class="fw-bold"><?= esc($systemInfo['database_version'] ?? 'Unknown') ?></div>
                    </div>
                    <div class="col-12 mb-3">
                        <small class="text-muted">Memory Usage</small>
                        <div class="fw-bold"><?= esc($systemInfo['memory_usage'] ?? 'Unknown') ?></div>
                    </div>
                    <div class="col-12 mb-3">
                        <small class="text-muted">Memory Limit</small>
                        <div class="fw-bold"><?= esc($systemInfo['memory_limit'] ?? 'Unknown') ?></div>
                    </div>
                    <div class="col-12">
                        <small class="text-muted">Server Software</small>
                        <div class="fw-bold small"><?= esc($systemInfo['server_software'] ?? 'Unknown') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary w-100">
                            <i class="fas fa-user-plus me-2"></i>Add Admin User
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('admin/users') ?>" class="btn btn-info w-100">
                            <i class="fas fa-users me-2"></i>Manage Users
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('admin/settings') ?>" class="btn btn-warning w-100">
                            <i class="fas fa-cog me-2"></i>System Settings
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('/') ?>" class="btn btn-secondary w-100" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>View Site
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-xs {
    font-size: 0.7rem;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
