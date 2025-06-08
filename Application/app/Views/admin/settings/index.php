<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">
            <i class="fas fa-cog me-2"></i>System Settings
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-sliders-h me-2"></i>General Settings
                </h6>
            </div>
            <div class="card-body">
                <!-- Validation Errors -->
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Please correct the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/settings/update') ?>" method="post" class="needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <!-- Site Information -->
                    <div class="mb-4">
                        <h5 class="text-primary border-bottom pb-2">
                            <i class="fas fa-globe me-2"></i>Site Information
                        </h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="site_name" class="form-label">Site Name <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control"
                                    id="site_name"
                                    name="site_name"
                                    value="<?= old('site_name', $settings['site_name'] ?? '') ?>"
                                    placeholder="Enter site name"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="site_email" class="form-label">Site Email <span class="text-danger">*</span></label>
                                <input type="email"
                                    class="form-control"
                                    id="site_email"
                                    name="site_email"
                                    value="<?= old('site_email', $settings['site_email'] ?? '') ?>"
                                    placeholder="Enter site email"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="site_description" class="form-label">Site Description</label>
                            <textarea class="form-control"
                                id="site_description"
                                name="site_description"
                                rows="3"
                                placeholder="Enter site description"><?= old('site_description', $settings['site_description'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- System Configuration -->
                    <div class="mb-4">
                        <h5 class="text-primary border-bottom pb-2">
                            <i class="fas fa-server me-2"></i>System Configuration
                        </h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="timezone" class="form-label">Timezone <span class="text-danger">*</span></label>
                                <select class="form-select" id="timezone" name="timezone" required>
                                    <option value="">Select Timezone</option>
                                    <?php
                                    $timezones = [
                                        'UTC' => 'UTC',
                                        'America/New_York' => 'Eastern Time',
                                        'America/Chicago' => 'Central Time',
                                        'America/Denver' => 'Mountain Time',
                                        'America/Los_Angeles' => 'Pacific Time',
                                        'Europe/London' => 'London',
                                        'Europe/Paris' => 'Paris',
                                        'Europe/Berlin' => 'Berlin',
                                        'Asia/Tokyo' => 'Tokyo',
                                        'Asia/Shanghai' => 'Shanghai',
                                        'Asia/Kolkata' => 'Kolkata',
                                        'Australia/Sydney' => 'Sydney',
                                    ];
                                    ?>
                                    <?php foreach ($timezones as $value => $label): ?>
                                        <option value="<?= $value ?>" <?= old('timezone', $settings['timezone'] ?? '') === $value ? 'selected' : '' ?>>
                                            <?= esc($label) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_format" class="form-label">Date Format <span class="text-danger">*</span></label>
                                <select class="form-select" id="date_format" name="date_format" required>
                                    <option value="">Select Date Format</option>
                                    <?php
                                    $dateFormats = [
                                        'Y-m-d H:i:s' => date('Y-m-d H:i:s'),
                                        'd/m/Y H:i:s' => date('d/m/Y H:i:s'),
                                        'm/d/Y H:i:s' => date('m/d/Y H:i:s'),
                                        'Y-m-d' => date('Y-m-d'),
                                        'd/m/Y' => date('d/m/Y'),
                                        'm/d/Y' => date('m/d/Y'),
                                    ];
                                    ?>
                                    <?php foreach ($dateFormats as $value => $label): ?>
                                        <option value="<?= $value ?>" <?= old('date_format', $settings['date_format'] ?? '') === $value ? 'selected' : '' ?>>
                                            <?= esc($label) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="items_per_page" class="form-label">Items Per Page <span class="text-danger">*</span></label>
                                <input type="number"
                                    class="form-control"
                                    id="items_per_page"
                                    name="items_per_page"
                                    value="<?= old('items_per_page', $settings['items_per_page'] ?? 20) ?>"
                                    min="5"
                                    max="100"
                                    required>
                                <small class="form-text text-muted">Number of items to display per page (5-100)</small>
                            </div>
                        </div>
                    </div>

                    <!-- Security & Access -->
                    <div class="mb-4">
                        <h5 class="text-primary border-bottom pb-2">
                            <i class="fas fa-shield-alt me-2"></i>Security & Access
                        </h5>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        id="maintenance_mode"
                                        name="maintenance_mode"
                                        value="1"
                                        <?= old('maintenance_mode', $settings['maintenance_mode'] ?? 0) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="maintenance_mode">
                                        <strong>Maintenance Mode</strong>
                                        <br><small class="text-muted">Put site in maintenance mode</small>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        id="allow_registration"
                                        name="allow_registration"
                                        value="1"
                                        <?= old('allow_registration', $settings['allow_registration'] ?? 1) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="allow_registration">
                                        <strong>Allow Registration</strong>
                                        <br><small class="text-muted">Allow new user registration</small>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        id="email_verification"
                                        name="email_verification"
                                        value="1"
                                        <?= old('email_verification', $settings['email_verification'] ?? 0) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="email_verification">
                                        <strong>Email Verification</strong>
                                        <br><small class="text-muted">Require email verification</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-info-circle me-2"></i>Settings Information
                </h6>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Configure your system settings here. These settings affect the overall behavior and appearance of your application.
                </p>

                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Note:</strong> Some settings may require a page refresh or cache clear to take effect.
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-backup me-2"></i>Backup Settings
                </h6>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Settings are automatically saved to a JSON file for backup purposes.
                </p>

                <div class="d-grid">
                    <button type="button" class="btn btn-outline-success" onclick="downloadSettings()">
                        <i class="fas fa-download me-2"></i>Download Settings
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        const form = document.querySelector('.needs-validation');
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    function downloadSettings() {
        // Create a simple settings backup
        const settings = {
            site_name: document.getElementById('site_name').value,
            site_email: document.getElementById('site_email').value,
            site_description: document.getElementById('site_description').value,
            timezone: document.getElementById('timezone').value,
            date_format: document.getElementById('date_format').value,
            items_per_page: document.getElementById('items_per_page').value,
            maintenance_mode: document.getElementById('maintenance_mode').checked,
            allow_registration: document.getElementById('allow_registration').checked,
            email_verification: document.getElementById('email_verification').checked,
            backup_date: new Date().toISOString()
        };

        const dataStr = JSON.stringify(settings, null, 2);
        const dataBlob = new Blob([dataStr], {
            type: 'application/json'
        });

        const link = document.createElement('a');
        link.href = URL.createObjectURL(dataBlob);
        link.download = 'admin_settings_backup_' + new Date().toISOString().split('T')[0] + '.json';
        link.click();
    }
</script>

<style>
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .border-bottom {
        border-bottom: 2px solid #e9ecef !important;
    }

    .form-switch .form-check-input {
        width: 2em;
        margin-left: -2.5em;
    }

    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffecb5;
        color: #664d03;
    }
</style>