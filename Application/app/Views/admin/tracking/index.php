<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Parcels</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format(array_sum($stats)) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Delivered</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['delivered']) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">In Transit</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['in_transit']) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shipping-fast fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($stats['pending']) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters and Actions -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tracking Management</h6>
        <div class="dropdown no-arrow">
            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/tracking/create') ?>">
                <i class="fas fa-plus me-2"></i>Add New Tracking
            </a>
        </div>
    </div>

    <div class="card-body">
        <!-- Filters -->
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search"
                        placeholder="Tracking number, sender, receiver..."
                        value="<?= esc($filters['search'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">All Statuses</option>
                        <?php foreach ($availableStatuses as $value => $label): ?>
                            <option value="<?= esc($value) ?>" <?= ($filters['status'] === $value) ? 'selected' : '' ?>>
                                <?= esc($label) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="service_type" class="form-label">Service Type</label>
                    <select class="form-select" id="service_type" name="service_type">
                        <option value="">All Services</option>
                        <?php foreach ($availableServiceTypes as $value => $label): ?>
                            <option value="<?= esc($value) ?>" <?= ($filters['service_type'] === $value) ? 'selected' : '' ?>>
                                <?= esc($label) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="date_from" class="form-label">Date From</label>
                    <input type="date" class="form-control" id="date_from" name="date_from"
                        value="<?= esc($filters['date_from'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <label for="date_to" class="form-label">Date To</label>
                    <input type="date" class="form-control" id="date_to" name="date_to"
                        value="<?= esc($filters['date_to'] ?? '') ?>">
                </div>
                <div class="col-md-1">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <a href="<?= base_url('admin/tracking') ?>" class="btn btn-outline-secondary btn-sm me-2">
                        <i class="fas fa-times me-1"></i>Clear Filters
                    </a>
                    <a href="<?= base_url('admin/tracking/export') . '?' . http_build_query($filters) ?>" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-download me-1"></i>Export CSV
                    </a>
                </div>
            </div>
        </form>

        <!-- Results -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Tracking Number</th>
                        <th>Status</th>
                        <th>Service Type</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Contents</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($trackingRecords)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No tracking records found.</p>
                                <a href="<?= base_url('admin/tracking/create') ?>" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add First Tracking Record
                                </a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($trackingRecords as $record): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($record['tracking_number']) ?></strong>
                                </td>
                                <td>
                                    <?php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'collected' => 'info',
                                        'in_transit' => 'primary',
                                        'out_for_delivery' => 'info',
                                        'delivered' => 'success',
                                        'failed_delivery' => 'danger',
                                        'returned' => 'secondary'
                                    ];
                                    $statusColor = $statusColors[$record['status']] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?= $statusColor ?>">
                                        <?= esc(ucfirst(str_replace('_', ' ', $record['status']))) ?>
                                    </span>
                                </td>
                                <td><?= esc($record['service_type']) ?></td>
                                <td>
                                    <div class="fw-bold"><?= esc($record['sender_company']) ?></div>
                                    <small class="text-muted"><?= esc($record['sender_contact']) ?></small>
                                </td>
                                <td>
                                    <div class="fw-bold"><?= esc($record['receiver_name']) ?></div>
                                    <small class="text-muted"><?= esc(substr($record['receiver_address'], 0, 30)) ?>...</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark"><?= esc($record['parcel_type']) ?></span>
                                    <div class="small text-muted"><?= esc(substr($record['parcel_contents'], 0, 30)) ?>...</div>
                                </td>
                                <td>
                                    <div><?= date('d M Y', strtotime($record['created_at'])) ?></div>
                                    <small class="text-muted"><?= date('H:i', strtotime($record['created_at'])) ?></small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('admin/tracking/view/' . $record['id']) ?>"
                                            class="btn btn-outline-info btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admin/tracking/edit/' . $record['id']) ?>"
                                            class="btn btn-outline-primary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="<?= base_url('admin/tracking/delete/' . $record['id']) ?>"
                                            class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tracking record?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-delete"
                                                title="Delete" data-item-name="tracking record <?= esc($record['tracking_number']) ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <nav aria-label="Tracking pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= base_url('admin/tracking?' . http_build_query(array_merge($filters, ['page' => $currentPage - 1]))) ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>

                    <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                        <li class="page-item <?= ($i === $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="<?= base_url('admin/tracking?' . http_build_query(array_merge($filters, ['page' => $i]))) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= base_url('admin/tracking?' . http_build_query(array_merge($filters, ['page' => $currentPage + 1]))) ?>">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="text-center text-muted">
                Showing <?= number_format(($currentPage - 1) * $perPage + 1) ?> to
                <?= number_format(min($currentPage * $perPage, $totalRecords)) ?> of
                <?= number_format($totalRecords) ?> results
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Quick Status Update Modal -->
<div class="modal fade" id="statusUpdateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="statusUpdateForm">
                    <input type="hidden" id="updateTrackingId" name="id">
                    <div class="mb-3">
                        <label for="updateStatus" class="form-label">New Status</label>
                        <select class="form-select" id="updateStatus" name="status" required>
                            <?php foreach ($availableStatuses as $value => $label): ?>
                                <option value="<?= esc($value) ?>"><?= esc($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateLocation" class="form-label">Location (Optional)</label>
                        <input type="text" class="form-control" id="updateLocation" name="location"
                            placeholder="Current location">
                    </div>
                    <div class="mb-3">
                        <label for="updateNotes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" id="updateNotes" name="notes" rows="3"
                            placeholder="Additional notes about this status update"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateStatus()">Update Status</button>
            </div>
        </div>
    </div>
</div>

<script>
    function updateStatus() {
        const form = document.getElementById('statusUpdateForm');
        const formData = new FormData(form);

        fetch('<?= base_url('admin/tracking/updateStatus') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the status.');
            });
    }
</script>