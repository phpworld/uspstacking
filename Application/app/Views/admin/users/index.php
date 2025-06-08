<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-users me-2"></i>Admin Users
            </h1>
            <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New User
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-table me-2"></i>All Admin Users
                </h6>
            </div>
            <div class="card-body">
                <?php if (!empty($users)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="usersTable">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= esc($user['id']) ?></td>
                                        <td>
                                            <strong><?= esc($user['username']) ?></strong>
                                            <?php if ($user['id'] == ($currentAdmin['id'] ?? 0)): ?>
                                                <span class="badge bg-info ms-1">You</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($user['first_name'] . ' ' . $user['last_name']) ?></td>
                                        <td><?= esc($user['email']) ?></td>
                                        <td>
                                            <?php
                                            $roleColors = [
                                                'super_admin' => 'danger',
                                                'admin' => 'primary',
                                                'moderator' => 'warning'
                                            ];
                                            $roleLabels = [
                                                'super_admin' => 'Super Admin',
                                                'admin' => 'Admin',
                                                'moderator' => 'Moderator'
                                            ];
                                            ?>
                                            <span class="badge bg-<?= $roleColors[$user['role']] ?? 'secondary' ?>">
                                                <?= $roleLabels[$user['role']] ?? ucfirst($user['role']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $statusColors = [
                                                'active' => 'success',
                                                'inactive' => 'secondary',
                                                'suspended' => 'danger'
                                            ];
                                            ?>
                                            <span class="badge bg-<?= $statusColors[$user['status']] ?? 'secondary' ?>">
                                                <?= ucfirst($user['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($user['last_login']): ?>
                                                <span title="<?= date('Y-m-d H:i:s', strtotime($user['last_login'])) ?>">
                                                    <?= date('M j, Y', strtotime($user['last_login'])) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-muted">Never</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span title="<?= date('Y-m-d H:i:s', strtotime($user['created_at'])) ?>">
                                                <?= date('M j, Y', strtotime($user['created_at'])) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('admin/users/edit/' . $user['id']) ?>" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <?php if ($user['id'] != ($currentAdmin['id'] ?? 0)): ?>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger btn-delete" 
                                                            data-user-id="<?= $user['id'] ?>"
                                                            data-username="<?= esc($user['username']) ?>"
                                                            title="Delete User">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No admin users found</h5>
                        <p class="text-muted">Get started by creating your first admin user.</p>
                        <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add First User
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the user <strong id="deleteUsername"></strong>?</p>
                <p class="text-danger">
                    <i class="fas fa-warning me-1"></i>
                    This action cannot be undone.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">
                    <i class="fas fa-trash me-2"></i>Delete User
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete button clicks
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const deleteUsernameSpan = document.getElementById('deleteUsername');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    let userIdToDelete = null;

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            userIdToDelete = this.getAttribute('data-user-id');
            const username = this.getAttribute('data-username');
            deleteUsernameSpan.textContent = username;
            deleteModal.show();
        });
    });

    // Handle confirm delete
    confirmDeleteBtn.addEventListener('click', function() {
        if (userIdToDelete) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `<?= base_url('admin/users/delete/') ?>${userIdToDelete}`;
            
            // Add CSRF token if available
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = 'csrf_token';
                csrfInput.value = csrfToken.getAttribute('content');
                form.appendChild(csrfInput);
            }
            
            document.body.appendChild(form);
            form.submit();
        }
    });

    // Initialize DataTable if available
    if (typeof DataTable !== 'undefined') {
        new DataTable('#usersTable', {
            pageLength: 25,
            order: [[0, 'desc']],
            columnDefs: [
                { orderable: false, targets: [8] } // Actions column
            ]
        });
    }
});
</script>

<style>
.table th {
    border-top: none;
    font-weight: 600;
    color: #5a5c69;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.badge {
    font-size: 0.75em;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.02);
}
</style>
