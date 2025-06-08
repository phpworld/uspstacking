<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add New Tracking Record</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= base_url('admin/tracking/store') ?>" id="trackingForm">
            <?= csrf_field() ?>
            
            <!-- Basic Information -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary border-bottom pb-2">Basic Information</h5>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tracking_number" class="form-label">Tracking Number</label>
                        <input type="text" class="form-control" id="tracking_number" name="tracking_number" 
                               value="<?= esc($generatedTrackingNumber) ?>" 
                               placeholder="Leave empty to auto-generate" maxlength="20">
                        <div class="form-text">Leave empty to auto-generate a unique tracking number</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <?php foreach ($availableStatuses as $value => $label): ?>
                                <option value="<?= esc($value) ?>" <?= ($value === 'pending') ? 'selected' : '' ?>>
                                    <?= esc($label) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="service_type" class="form-label">Service Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="service_type" name="service_type" required>
                            <option value="">Select Service Type</option>
                            <?php foreach ($availableServiceTypes as $value => $label): ?>
                                <option value="<?= esc($value) ?>"><?= esc($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Sender Information -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary border-bottom pb-2">Sender Information</h5>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sender_company" class="form-label">Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sender_company" name="sender_company" 
                               required maxlength="200" value="<?= old('sender_company') ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sender_contact" class="form-label">Contact Person <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sender_contact" name="sender_contact" 
                               required maxlength="100" value="<?= old('sender_contact') ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="sender_address" class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="sender_address" name="sender_address" 
                                  rows="3" required><?= old('sender_address') ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="sender_phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="sender_phone" name="sender_phone" 
                               maxlength="20" value="<?= old('sender_phone') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="sender_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="sender_email" name="sender_email" 
                               maxlength="100" value="<?= old('sender_email') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="sender_reference" class="form-label">Reference</label>
                        <input type="text" class="form-control" id="sender_reference" name="sender_reference" 
                               maxlength="100" value="<?= old('sender_reference') ?>">
                    </div>
                </div>
            </div>

            <!-- Receiver Information -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary border-bottom pb-2">Receiver Information</h5>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="receiver_title" class="form-label">Title</label>
                        <select class="form-select" id="receiver_title" name="receiver_title">
                            <option value="">Select</option>
                            <option value="Mr" <?= (old('receiver_title') === 'Mr') ? 'selected' : '' ?>>Mr</option>
                            <option value="Mrs" <?= (old('receiver_title') === 'Mrs') ? 'selected' : '' ?>>Mrs</option>
                            <option value="Miss" <?= (old('receiver_title') === 'Miss') ? 'selected' : '' ?>>Miss</option>
                            <option value="Ms" <?= (old('receiver_title') === 'Ms') ? 'selected' : '' ?>>Ms</option>
                            <option value="Dr" <?= (old('receiver_title') === 'Dr') ? 'selected' : '' ?>>Dr</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="mb-3">
                        <label for="receiver_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="receiver_name" name="receiver_name" 
                               required maxlength="100" value="<?= old('receiver_name') ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="receiver_address" class="form-label">Delivery Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="receiver_address" name="receiver_address" 
                                  rows="3" required><?= old('receiver_address') ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="receiver_phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="receiver_phone" name="receiver_phone" 
                               maxlength="20" value="<?= old('receiver_phone') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="receiver_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="receiver_email" name="receiver_email" 
                               maxlength="100" value="<?= old('receiver_email') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="signature_required" class="form-label">Signature Required</label>
                        <select class="form-select" id="signature_required" name="signature_required">
                            <option value="0" <?= (old('signature_required') === '0') ? 'selected' : '' ?>>No</option>
                            <option value="1" <?= (old('signature_required') === '1') ? 'selected' : '' ?>>Yes</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="receiver_instructions" class="form-label">Special Instructions</label>
                        <textarea class="form-control" id="receiver_instructions" name="receiver_instructions" 
                                  rows="2" placeholder="e.g., Leave with neighbour, Safe place instructions"><?= old('receiver_instructions') ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Parcel Information -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary border-bottom pb-2">Parcel Information</h5>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="parcel_type" class="form-label">Parcel Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="parcel_type" name="parcel_type" required>
                            <option value="">Select Type</option>
                            <?php foreach ($availableParcelTypes as $value => $label): ?>
                                <option value="<?= esc($value) ?>" <?= (old('parcel_type') === $value) ? 'selected' : '' ?>>
                                    <?= esc($label) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="parcel_weight" class="form-label">Weight</label>
                        <input type="text" class="form-control" id="parcel_weight" name="parcel_weight" 
                               placeholder="e.g., 2.5kg" maxlength="20" value="<?= old('parcel_weight') ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="parcel_dimensions" class="form-label">Dimensions</label>
                        <input type="text" class="form-control" id="parcel_dimensions" name="parcel_dimensions" 
                               placeholder="e.g., 30x20x10cm" maxlength="50" value="<?= old('parcel_dimensions') ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="parcel_value" class="form-label">Value (£)</label>
                        <input type="number" class="form-control" id="parcel_value" name="parcel_value" 
                               step="0.01" min="0" max="99999.99" value="<?= old('parcel_value') ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="parcel_contents" class="form-label">Contents <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="parcel_contents" name="parcel_contents" 
                                  rows="2" required maxlength="500" 
                                  placeholder="Describe the contents of the parcel"><?= old('parcel_contents') ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="parcel_insurance" class="form-label">Insurance (£)</label>
                        <input type="number" class="form-control" id="parcel_insurance" name="parcel_insurance" 
                               step="0.01" min="0" max="99999.99" value="<?= old('parcel_insurance') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="parcel_postage" class="form-label">Postage Cost (£)</label>
                        <input type="number" class="form-control" id="parcel_postage" name="parcel_postage" 
                               step="0.01" min="0" max="999.99" value="<?= old('parcel_postage') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="estimated_delivery" class="form-label">Estimated Delivery</label>
                        <input type="datetime-local" class="form-control" id="estimated_delivery" name="estimated_delivery" 
                               value="<?= old('estimated_delivery') ?>">
                    </div>
                </div>
            </div>

            <!-- Location Information -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-primary border-bottom pb-2">Current Location (Optional)</h5>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="current_location" class="form-label">Current Location</label>
                        <input type="text" class="form-control" id="current_location" name="current_location" 
                               maxlength="200" value="<?= old('current_location') ?>" 
                               placeholder="e.g., Regional Sorting Facility">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="current_facility" class="form-label">Current Facility</label>
                        <input type="text" class="form-control" id="current_facility" name="current_facility" 
                               maxlength="200" value="<?= old('current_facility') ?>" 
                               placeholder="e.g., London Mail Centre">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="notes" class="form-label">Additional Notes</label>
                        <textarea class="form-control" id="notes" name="notes" 
                                  rows="3" placeholder="Any additional notes about this parcel"><?= old('notes') ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/tracking') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                        <div>
                            <button type="button" class="btn btn-outline-primary me-2" onclick="generateTrackingNumber()">
                                <i class="fas fa-sync me-2"></i>Generate New Tracking Number
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Create Tracking Record
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function generateTrackingNumber() {
    fetch('<?= base_url('admin/tracking/generateNumber') ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('tracking_number').value = data.tracking_number;
        } else {
            alert('Error generating tracking number');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Fallback: generate a simple tracking number
        const timestamp = Date.now().toString().slice(-9);
        document.getElementById('tracking_number').value = 'RM' + timestamp + 'GB';
    });
}

// Form validation
document.getElementById('trackingForm').addEventListener('submit', function(e) {
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('is-invalid');
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Please fill in all required fields.');
    }
});
</script>
