<!-- Tracking Header -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Tracking Details</h6>
        <div>
            <span class="badge bg-secondary fs-6"><?= esc($tracking['tracking_number']) ?></span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3">Tracking Number: <?= esc($tracking['tracking_number']) ?></h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Status:</strong> 
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
                            $statusColor = $statusColors[$tracking['status']] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?= $statusColor ?> fs-6">
                                <?= esc(ucfirst(str_replace('_', ' ', $tracking['status']))) ?>
                            </span>
                        </p>
                        <p><strong>Service Type:</strong> <?= esc($tracking['service_type']) ?></p>
                        <p><strong>Created:</strong> <?= date('d M Y H:i', strtotime($tracking['created_at'])) ?></p>
                        <p><strong>Last Updated:</strong> <?= date('d M Y H:i', strtotime($tracking['updated_at'])) ?></p>
                    </div>
                    <div class="col-md-6">
                        <?php if ($tracking['estimated_delivery']): ?>
                            <p><strong>Estimated Delivery:</strong> <?= date('d M Y H:i', strtotime($tracking['estimated_delivery'])) ?></p>
                        <?php endif; ?>
                        <?php if ($tracking['actual_delivery']): ?>
                            <p><strong>Actual Delivery:</strong> <?= date('d M Y H:i', strtotime($tracking['actual_delivery'])) ?></p>
                        <?php endif; ?>
                        <p><strong>Signature Required:</strong> <?= $tracking['signature_required'] ? 'Yes' : 'No' ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="btn-group" role="group">
                    <a href="<?= base_url('admin/tracking/edit/' . $tracking['id']) ?>" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#statusUpdateModal">
                        <i class="fas fa-sync me-2"></i>Update Status
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Information Cards -->
<div class="row mb-4">
    <!-- Sender Information -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header bg-light">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-tie me-2"></i>Sender Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Company:</strong></td>
                        <td><?= esc($tracking['sender_company']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact:</strong></td>
                        <td><?= esc($tracking['sender_contact']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td><?= nl2br(esc($tracking['sender_address'])) ?></td>
                    </tr>
                    <?php if ($tracking['sender_phone']): ?>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td><?= esc($tracking['sender_phone']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['sender_email']): ?>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?= esc($tracking['sender_email']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['sender_reference']): ?>
                    <tr>
                        <td><strong>Reference:</strong></td>
                        <td><?= esc($tracking['sender_reference']) ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <!-- Receiver Information -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header bg-light">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-user me-2"></i>Receiver Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td><?= esc($tracking['receiver_title'] ? $tracking['receiver_title'] . ' ' : '') . esc($tracking['receiver_name']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td><?= nl2br(esc($tracking['receiver_address'])) ?></td>
                    </tr>
                    <?php if ($tracking['receiver_phone']): ?>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td><?= esc($tracking['receiver_phone']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['receiver_email']): ?>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?= esc($tracking['receiver_email']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['receiver_instructions']): ?>
                    <tr>
                        <td><strong>Instructions:</strong></td>
                        <td><?= nl2br(esc($tracking['receiver_instructions'])) ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <!-- Parcel Information -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header bg-light">
                <h6 class="m-0 font-weight-bold text-warning">
                    <i class="fas fa-box me-2"></i>Parcel Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Type:</strong></td>
                        <td><?= esc($tracking['parcel_type']) ?></td>
                    </tr>
                    <?php if ($tracking['parcel_weight']): ?>
                    <tr>
                        <td><strong>Weight:</strong></td>
                        <td><?= esc($tracking['parcel_weight']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['parcel_dimensions']): ?>
                    <tr>
                        <td><strong>Dimensions:</strong></td>
                        <td><?= esc($tracking['parcel_dimensions']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td><strong>Contents:</strong></td>
                        <td><?= esc($tracking['parcel_contents']) ?></td>
                    </tr>
                    <?php if ($tracking['parcel_value']): ?>
                    <tr>
                        <td><strong>Value:</strong></td>
                        <td>£<?= number_format($tracking['parcel_value'], 2) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['parcel_insurance']): ?>
                    <tr>
                        <td><strong>Insurance:</strong></td>
                        <td>£<?= number_format($tracking['parcel_insurance'], 2) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['parcel_postage']): ?>
                    <tr>
                        <td><strong>Postage:</strong></td>
                        <td>£<?= number_format($tracking['parcel_postage'], 2) ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <!-- Current Location -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header bg-light">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-map-marker-alt me-2"></i>Current Location
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <?php if ($tracking['current_location']): ?>
                    <tr>
                        <td><strong>Location:</strong></td>
                        <td><?= esc($tracking['current_location']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['current_facility']): ?>
                    <tr>
                        <td><strong>Facility:</strong></td>
                        <td><?= esc($tracking['current_facility']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['facility_address']): ?>
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td><?= nl2br(esc($tracking['facility_address'])) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['distance_from_destination']): ?>
                    <tr>
                        <td><strong>Distance:</strong></td>
                        <td><?= esc($tracking['distance_from_destination']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['postcode_area']): ?>
                    <tr>
                        <td><strong>Postcode Area:</strong></td>
                        <td><?= esc($tracking['postcode_area']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['delivery_round']): ?>
                    <tr>
                        <td><strong>Delivery Round:</strong></td>
                        <td><?= esc($tracking['delivery_round']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($tracking['last_location_update']): ?>
                    <tr>
                        <td><strong>Last Update:</strong></td>
                        <td><?= date('d M Y H:i', strtotime($tracking['last_location_update'])) ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
                
                <?php if (!$tracking['current_location'] && !$tracking['current_facility']): ?>
                    <p class="text-muted">No location information available</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Timeline -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-info">
            <i class="fas fa-history me-2"></i>Tracking Timeline
        </h6>
        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#addEventModal">
            <i class="fas fa-plus me-2"></i>Add Event
        </button>
    </div>
    <div class="card-body">
        <?php if (empty($timeline)): ?>
            <p class="text-muted text-center py-4">No timeline events found.</p>
        <?php else: ?>
            <div class="timeline">
                <?php foreach ($timeline as $index => $event): ?>
                    <div class="timeline-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="timeline-marker">
                            <i class="<?= esc($event['icon']) ?> text-<?= esc($event['color']) ?>"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="timeline-title"><?= esc($event['status']) ?></h6>
                            <p class="timeline-description"><?= esc($event['description']) ?></p>
                            <div class="timeline-meta">
                                <span class="timeline-date">
                                    <i class="fas fa-clock me-1"></i><?= esc($event['datetime']) ?>
                                </span>
                                <span class="timeline-location">
                                    <i class="fas fa-map-marker-alt me-1"></i><?= esc($event['location']) ?>
                                </span>
                                <?php if ($event['facility']): ?>
                                    <span class="timeline-facility">
                                        <i class="fas fa-building me-1"></i><?= esc($event['facility']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if ($event['notes']): ?>
                                <div class="timeline-notes mt-2">
                                    <small class="text-muted"><?= esc($event['notes']) ?></small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Additional Notes -->
<?php if ($tracking['notes']): ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">
            <i class="fas fa-sticky-note me-2"></i>Additional Notes
        </h6>
    </div>
    <div class="card-body">
        <p><?= nl2br(esc($tracking['notes'])) ?></p>
    </div>
</div>
<?php endif; ?>

<!-- Action Buttons -->
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <a href="<?= base_url('admin/tracking') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
            <div>
                <a href="<?= base_url('track/' . $tracking['tracking_number']) ?>" class="btn btn-outline-info me-2" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>View Public Tracking
                </a>
                <a href="<?= base_url('admin/tracking/edit/' . $tracking['id']) ?>" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Tracking
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusUpdateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="statusUpdateForm">
                    <input type="hidden" name="id" value="<?= $tracking['id'] ?>">
                    <div class="mb-3">
                        <label for="updateStatus" class="form-label">New Status</label>
                        <select class="form-select" id="updateStatus" name="status" required>
                            <?php foreach ($availableStatuses as $value => $label): ?>
                                <option value="<?= esc($value) ?>" <?= ($tracking['status'] === $value) ? 'selected' : '' ?>>
                                    <?= esc($label) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateLocation" class="form-label">Location (Optional)</label>
                        <input type="text" class="form-control" id="updateLocation" name="location" 
                               placeholder="Current location" value="<?= esc($tracking['current_location']) ?>">
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

<!-- Add Timeline Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Timeline Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addEventForm">
                    <input type="hidden" name="tracking_id" value="<?= $tracking['id'] ?>">
                    <div class="mb-3">
                        <label for="eventStatus" class="form-label">Status</label>
                        <input type="text" class="form-control" id="eventStatus" name="status" required 
                               placeholder="e.g., Processing at facility">
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="eventDescription" name="description" rows="2" required 
                                  placeholder="Describe what happened"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="eventLocation" class="form-label">Location</label>
                        <input type="text" class="form-control" id="eventLocation" name="location" required 
                               placeholder="Where this event occurred">
                    </div>
                    <div class="mb-3">
                        <label for="eventFacility" class="form-label">Facility (Optional)</label>
                        <input type="text" class="form-control" id="eventFacility" name="facility" 
                               placeholder="Facility name">
                    </div>
                    <div class="mb-3">
                        <label for="eventNotes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" id="eventNotes" name="notes" rows="2" 
                                  placeholder="Additional notes"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addTimelineEvent()">Add Event</button>
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

function addTimelineEvent() {
    const form = document.getElementById('addEventForm');
    const formData = new FormData(form);
    
    fetch('<?= base_url('admin/tracking/addTimelineEvent') ?>', {
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
        alert('An error occurred while adding the timeline event.');
    });
}
</script>
