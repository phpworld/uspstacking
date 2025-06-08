<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-user-plus me-2"></i>Create Admin User
            </h1>
            <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Users
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-circle me-2"></i>User Information
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

                <form action="<?= base_url('admin/users/store') ?>" method="post" class="needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control <?= session()->getFlashdata('errors')['username'] ?? false ? 'is-invalid' : '' ?>"
                                id="username"
                                name="username"
                                value="<?= old('username') ?>"
                                placeholder="Enter username"
                                required>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['username'] ?? 'Please provide a valid username.' ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email"
                                class="form-control <?= session()->getFlashdata('errors')['email'] ?? false ? 'is-invalid' : '' ?>"
                                id="email"
                                name="email"
                                value="<?= old('email') ?>"
                                placeholder="Enter email address"
                                required>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['email'] ?? 'Please provide a valid email address.' ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control <?= session()->getFlashdata('errors')['first_name'] ?? false ? 'is-invalid' : '' ?>"
                                id="first_name"
                                name="first_name"
                                value="<?= old('first_name') ?>"
                                placeholder="Enter first name"
                                required>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['first_name'] ?? 'Please provide a first name.' ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control <?= session()->getFlashdata('errors')['last_name'] ?? false ? 'is-invalid' : '' ?>"
                                id="last_name"
                                name="last_name"
                                value="<?= old('last_name') ?>"
                                placeholder="Enter last name"
                                required>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['last_name'] ?? 'Please provide a last name.' ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control <?= session()->getFlashdata('errors')['password'] ?? false ? 'is-invalid' : '' ?>"
                                    id="password"
                                    name="password"
                                    placeholder="Enter password"
                                    required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['password'] ?? 'Please provide a password (minimum 8 characters).' ?>
                                </div>
                            </div>
                            <small class="form-text text-muted">Minimum 8 characters required.</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control <?= session()->getFlashdata('errors')['confirm_password'] ?? false ? 'is-invalid' : '' ?>"
                                    id="confirm_password"
                                    name="confirm_password"
                                    placeholder="Confirm password"
                                    required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['confirm_password'] ?? 'Passwords must match.' ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select <?= session()->getFlashdata('errors')['role'] ?? false ? 'is-invalid' : '' ?>"
                                id="role"
                                name="role"
                                required>
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $roleValue => $roleLabel): ?>
                                    <option value="<?= $roleValue ?>" <?= old('role') === $roleValue ? 'selected' : '' ?>>
                                        <?= esc($roleLabel) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['role'] ?? 'Please select a role.' ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select <?= session()->getFlashdata('errors')['status'] ?? false ? 'is-invalid' : '' ?>"
                                id="status"
                                name="status"
                                required>
                                <option value="">Select Status</option>
                                <option value="active" <?= old('status') === 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['status'] ?? 'Please select a status.' ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Create User
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-info-circle me-2"></i>Role Permissions
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-danger">
                        <i class="fas fa-crown me-2"></i>Super Admin
                    </h6>
                    <small class="text-muted">
                        Full access to all features including user management, settings, and system administration.
                    </small>
                </div>

                <div class="mb-3">
                    <h6 class="text-primary">
                        <i class="fas fa-user-shield me-2"></i>Admin
                    </h6>
                    <small class="text-muted">
                        Can manage users (except super admins), access settings, and perform most administrative tasks.
                    </small>
                </div>

                <div class="mb-3">
                    <h6 class="text-warning">
                        <i class="fas fa-user-edit me-2"></i>Moderator
                    </h6>
                    <small class="text-muted">
                        Limited access to content moderation and basic administrative functions.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        function togglePasswordVisibility(inputId, buttonId) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const icon = button.querySelector('i');

            button.addEventListener('click', function() {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }

        togglePasswordVisibility('password', 'togglePassword');
        togglePasswordVisibility('confirm_password', 'toggleConfirmPassword');

        // Form validation
        const form = document.querySelector('.needs-validation');
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            // Check if passwords match
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                event.preventDefault();
                event.stopPropagation();
                document.getElementById('confirm_password').setCustomValidity('Passwords do not match');
            } else {
                document.getElementById('confirm_password').setCustomValidity('');
            }

            form.classList.add('was-validated');
        });

        // Real-time password confirmation validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;

            if (password !== confirmPassword) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    });
</script>