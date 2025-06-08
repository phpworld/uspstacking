<?php

namespace App\Controllers\Admin;

use App\Models\TrackingModel;
use App\Models\TrackingTimelineModel;

class TrackingController extends BaseAdminController
{
    protected $trackingModel;
    protected $timelineModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->trackingModel = new TrackingModel();
        $this->timelineModel = new TrackingTimelineModel();
    }

    /**
     * List all tracking records
     */
    public function index()
    {
        $this->setPageTitle('Tracking Management');
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard'],
            ['title' => 'Tracking Management', 'url' => '/admin/tracking', 'active' => true]
        ]);

        // Get filters from request
        $filters = [
            'status' => $this->request->getGet('status'),
            'service_type' => $this->request->getGet('service_type'),
            'search' => $this->request->getGet('search'),
            'date_from' => $this->request->getGet('date_from'),
            'date_to' => $this->request->getGet('date_to')
        ];

        // Pagination
        $perPage = 20;
        $page = (int)($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        // Get tracking records
        $trackingRecords = $this->trackingModel->getTrackingList($perPage, $offset, $filters);
        $totalRecords = $this->trackingModel->getTrackingCount($filters);
        $totalPages = ceil($totalRecords / $perPage);

        // Get statistics
        $stats = $this->trackingModel->getStatusStats();

        $data = [
            'trackingRecords' => $trackingRecords,
            'totalRecords' => $totalRecords,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'perPage' => $perPage,
            'filters' => $filters,
            'stats' => $stats,
            'availableStatuses' => $this->trackingModel->getAvailableStatuses(),
            'availableServiceTypes' => $this->trackingModel->getAvailableServiceTypes()
        ];

        return $this->renderView('admin/tracking/index', $data);
    }

    /**
     * Show create tracking form
     */
    public function create()
    {
        $this->setPageTitle('Add New Tracking');
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard'],
            ['title' => 'Tracking Management', 'url' => '/admin/tracking'],
            ['title' => 'Add New Tracking', 'url' => '/admin/tracking/create', 'active' => true]
        ]);

        $data = [
            'availableStatuses' => $this->trackingModel->getAvailableStatuses(),
            'availableServiceTypes' => $this->trackingModel->getAvailableServiceTypes(),
            'availableParcelTypes' => $this->trackingModel->getAvailableParcelTypes(),
            'generatedTrackingNumber' => $this->trackingModel->generateTrackingNumber()
        ];

        return $this->renderView('admin/tracking/create', $data);
    }

    /**
     * Store new tracking record
     */
    public function store()
    {
        $data = $this->request->getPost();

        // Generate tracking number if not provided
        if (empty($data['tracking_number'])) {
            $data['tracking_number'] = $this->trackingModel->generateTrackingNumber();
        } else {
            $data['tracking_number'] = strtoupper($data['tracking_number']);
        }

        // Add created_by
        $data['created_by'] = $this->currentAdmin['id'] ?? 1;

        // Validate and save
        if ($this->trackingModel->saveWithValidation($data)) {
            $trackingId = $this->trackingModel->getInsertID();

            // Create timeline events
            $this->timelineModel->createDefaultTimeline($trackingId, $data['status']);

            return redirect()->to('/admin/tracking')
                ->with('success', 'Tracking record created successfully. Tracking Number: ' . $data['tracking_number']);
        } else {
            $errors = $this->trackingModel->errors();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create tracking record: ' . implode(', ', $errors));
        }
    }

    /**
     * Show tracking details
     */
    public function view($id)
    {
        $tracking = $this->trackingModel->find($id);

        if (!$tracking) {
            return redirect()->to('/admin/tracking')
                ->with('error', 'Tracking record not found.');
        }

        $this->setPageTitle('Tracking Details - ' . $tracking['tracking_number']);
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard'],
            ['title' => 'Tracking Management', 'url' => '/admin/tracking'],
            ['title' => 'Tracking Details', 'url' => '/admin/tracking/view/' . $id, 'active' => true]
        ]);

        // Get timeline
        $timeline = $this->timelineModel->getFormattedTimeline($id);

        $data = [
            'tracking' => $tracking,
            'timeline' => $timeline,
            'availableStatuses' => $this->trackingModel->getAvailableStatuses()
        ];

        return $this->renderView('admin/tracking/view', $data);
    }

    /**
     * Show edit tracking form
     */
    public function edit($id)
    {
        $tracking = $this->trackingModel->find($id);

        if (!$tracking) {
            return redirect()->to('/admin/tracking')
                ->with('error', 'Tracking record not found.');
        }

        $this->setPageTitle('Edit Tracking - ' . $tracking['tracking_number']);
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard'],
            ['title' => 'Tracking Management', 'url' => '/admin/tracking'],
            ['title' => 'Edit Tracking', 'url' => '/admin/tracking/edit/' . $id, 'active' => true]
        ]);

        $data = [
            'tracking' => $tracking,
            'availableStatuses' => $this->trackingModel->getAvailableStatuses(),
            'availableServiceTypes' => $this->trackingModel->getAvailableServiceTypes(),
            'availableParcelTypes' => $this->trackingModel->getAvailableParcelTypes()
        ];

        return $this->renderView('admin/tracking/edit', $data);
    }

    /**
     * Update tracking record
     */
    public function update($id)
    {
        $tracking = $this->trackingModel->find($id);

        if (!$tracking) {
            return redirect()->to('/admin/tracking')
                ->with('error', 'Tracking record not found.');
        }

        $data = $this->request->getPost();
        $data['updated_by'] = $this->currentAdmin['id'] ?? 1;

        // Check if status changed
        $statusChanged = $tracking['status'] !== $data['status'];
        $oldStatus = $tracking['status'];

        // Update tracking record
        if ($this->trackingModel->saveWithValidation($data, $id)) {
            // If status changed, add timeline event
            if ($statusChanged) {
                $this->timelineModel->updateTimelineForStatusChange(
                    $id,
                    $data['status'],
                    [
                        'location' => $data['current_location'] ?? null,
                        'facility' => $data['current_facility'] ?? null,
                        'notes' => "Status changed from " . ucfirst(str_replace('_', ' ', $oldStatus)) . " to " . ucfirst(str_replace('_', ' ', $data['status']))
                    ]
                );
            }

            return redirect()->to('/admin/tracking')
                ->with('success', 'Tracking record updated successfully.');
        } else {
            $errors = $this->trackingModel->errors();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update tracking record: ' . implode(', ', $errors));
        }
    }

    /**
     * Delete tracking record
     */
    public function delete($id)
    {
        $tracking = $this->trackingModel->find($id);

        if (!$tracking) {
            return redirect()->to('/admin/tracking')
                ->with('error', 'Tracking record not found.');
        }

        // Delete timeline events first
        $this->timelineModel->where('tracking_id', $id)->delete();

        // Delete tracking record
        if ($this->trackingModel->delete($id)) {
            return redirect()->to('/admin/tracking')
                ->with('success', 'Tracking record deleted successfully.');
        } else {
            return redirect()->to('/admin/tracking')
                ->with('error', 'Failed to delete tracking record.');
        }
    }

    /**
     * Quick status update via AJAX
     */
    public function updateStatus()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $location = $this->request->getPost('location');
        $notes = $this->request->getPost('notes');

        $tracking = $this->trackingModel->find($id);

        if (!$tracking) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tracking record not found']);
        }

        $updateData = [
            'status' => $status,
            'updated_by' => $this->currentAdmin['id'] ?? 1
        ];

        if (!empty($location)) {
            $updateData['current_location'] = $location;
        }

        if ($this->trackingModel->update($id, $updateData)) {
            // Add timeline event
            $this->timelineModel->updateTimelineForStatusChange(
                $id,
                $status,
                [
                    'location' => $location,
                    'notes' => $notes
                ]
            );

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status updated successfully',
                'new_status' => ucfirst(str_replace('_', ' ', $status))
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update status'
            ]);
        }
    }

    /**
     * Add timeline event via AJAX
     */
    public function addTimelineEvent()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $trackingId = $this->request->getPost('tracking_id');
        $eventData = [
            'status' => $this->request->getPost('status'),
            'description' => $this->request->getPost('description'),
            'location' => $this->request->getPost('location'),
            'facility' => $this->request->getPost('facility'),
            'notes' => $this->request->getPost('notes'),
            'created_by' => $this->currentAdmin['id'] ?? 1
        ];

        if ($this->timelineModel->addTimelineEvent($trackingId, $eventData)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Timeline event added successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to add timeline event'
            ]);
        }
    }

    /**
     * Generate tracking number via AJAX
     */
    public function generateNumber()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $trackingNumber = $this->trackingModel->generateTrackingNumber();

        return $this->response->setJSON([
            'success' => true,
            'tracking_number' => $trackingNumber
        ]);
    }

    /**
     * Export tracking data to CSV
     */
    public function export()
    {
        $filters = [
            'status' => $this->request->getGet('status'),
            'service_type' => $this->request->getGet('service_type'),
            'search' => $this->request->getGet('search'),
            'date_from' => $this->request->getGet('date_from'),
            'date_to' => $this->request->getGet('date_to')
        ];

        $trackingRecords = $this->trackingModel->getTrackingList(10000, 0, $filters);

        $filename = 'tracking_export_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // CSV headers
        fputcsv($output, [
            'Tracking Number',
            'Status',
            'Service Type',
            'Sender Company',
            'Receiver Name',
            'Parcel Type',
            'Weight',
            'Contents',
            'Current Location',
            'Created Date'
        ]);

        // CSV data
        foreach ($trackingRecords as $record) {
            fputcsv($output, [
                $record['tracking_number'],
                ucfirst(str_replace('_', ' ', $record['status'])),
                $record['service_type'],
                $record['sender_company'],
                $record['receiver_name'],
                $record['parcel_type'],
                $record['parcel_weight'],
                $record['parcel_contents'],
                $record['current_location'],
                $record['created_at']
            ]);
        }

        fclose($output);
        exit;
    }
}
