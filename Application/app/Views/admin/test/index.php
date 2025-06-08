<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">
            <i class="fas fa-check-circle me-2 text-success"></i>Admin Panel Test
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-thumbs-up me-2"></i>Success!
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">
                        <i class="fas fa-check-circle me-2"></i>Admin Panel is Working!
                    </h4>
                    <p>Congratulations! Your admin panel is successfully installed and running.</p>
                    <hr>
                    <p class="mb-0">You can now proceed to set up your database and create admin users.</p>
                </div>

                <h5 class="mt-4">Next Steps:</h5>
                <ol>
                    <li><strong>Configure Database:</strong> Update your <code>.env</code> file with database credentials</li>
                    <li><strong>Run Migrations:</strong> Execute <code>php spark migrate</code></li>
                    <li><strong>Create Admin User:</strong> Run <code>php spark db:seed AdminUserSeeder</code></li>
                    <li><strong>Login:</strong> Access <code>/admin</code> with username: <code>admin</code> and password: <code>password123</code></li>
                </ol>

                <h5 class="mt-4">System Information:</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>PHP Version</strong></td>
                            <td><?= PHP_VERSION ?></td>
                        </tr>
                        <tr>
                            <td><strong>CodeIgniter Version</strong></td>
                            <td><?= \CodeIgniter\CodeIgniter::CI_VERSION ?></td>
                        </tr>
                        <tr>
                            <td><strong>Server Software</strong></td>
                            <td><?= $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' ?></td>
                        </tr>
                        <tr>
                            <td><strong>Memory Usage</strong></td>
                            <td><?= round(memory_get_usage(true) / 1024 / 1024, 2) ?> MB</td>
                        </tr>
                        <tr>
                            <td><strong>Current Time</strong></td>
                            <td><?= date('Y-m-d H:i:s') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-info-circle me-2"></i>Quick Setup
                </h6>
            </div>
            <div class="card-body">
                <p>Run the setup script to automatically configure your admin panel:</p>
                
                <div class="bg-dark text-light p-3 rounded mb-3">
                    <code>php setup_admin.php</code>
                </div>

                <p class="small text-muted">
                    This will create the database tables and default admin user for you.
                </p>
            </div>
        </div>

        <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">
                    <i class="fas fa-tools me-2"></i>Manual Setup
                </h6>
            </div>
            <div class="card-body">
                <p>Or run commands manually:</p>
                
                <div class="bg-dark text-light p-3 rounded mb-2">
                    <code>php spark migrate</code>
                </div>
                
                <div class="bg-dark text-light p-3 rounded">
                    <code>php spark db:seed AdminUserSeeder</code>
                </div>
            </div>
        </div>
    </div>
</div>
