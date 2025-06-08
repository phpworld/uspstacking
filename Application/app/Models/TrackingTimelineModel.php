<?php

namespace App\Models;

use CodeIgniter\Model;

class TrackingTimelineModel extends Model
{
    protected $table            = 'tracking_timeline';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tracking_id',
        'status',
        'description',
        'location',
        'facility',
        'event_date',
        'event_time',
        'icon',
        'color',
        'notes',
        'created_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'tracking_id'  => 'required|integer',
        'status'       => 'required|max_length[100]',
        'description'  => 'required|max_length[500]',
        'location'     => 'required|max_length[200]',
        'event_date'   => 'required|valid_date[Y-m-d]',
        'event_time'   => 'required|valid_date[H:i:s]',
        'icon'         => 'permit_empty|max_length[50]',
        'color'        => 'permit_empty|max_length[20]'
    ];

    /**
     * Get timeline for a tracking record
     */
    public function getTimelineByTrackingId(int $trackingId): array
    {
        return $this->where('tracking_id', $trackingId)
                   ->orderBy('event_date', 'DESC')
                   ->orderBy('event_time', 'DESC')
                   ->findAll();
    }

    /**
     * Add timeline event
     */
    public function addTimelineEvent(int $trackingId, array $eventData): bool
    {
        $data = array_merge([
            'tracking_id' => $trackingId,
            'event_date' => date('Y-m-d'),
            'event_time' => date('H:i:s'),
            'icon' => $this->getStatusIcon($eventData['status'] ?? ''),
            'color' => $this->getStatusColor($eventData['status'] ?? '')
        ], $eventData);

        return $this->insert($data) !== false;
    }

    /**
     * Get status icon
     */
    private function getStatusIcon(string $status): string
    {
        $icons = [
            'pending' => 'fas fa-clock',
            'collected' => 'fas fa-box',
            'in_transit' => 'fas fa-shipping-fast',
            'out_for_delivery' => 'fas fa-truck',
            'delivered' => 'fas fa-check-circle',
            'failed_delivery' => 'fas fa-exclamation-triangle',
            'returned' => 'fas fa-undo'
        ];

        return $icons[strtolower($status)] ?? 'fas fa-info-circle';
    }

    /**
     * Get status color
     */
    private function getStatusColor(string $status): string
    {
        $colors = [
            'pending' => 'warning',
            'collected' => 'info',
            'in_transit' => 'primary',
            'out_for_delivery' => 'info',
            'delivered' => 'success',
            'failed_delivery' => 'danger',
            'returned' => 'secondary'
        ];

        return $colors[strtolower($status)] ?? 'secondary';
    }

    /**
     * Create default timeline events for new tracking
     */
    public function createDefaultTimeline(int $trackingId, string $initialStatus = 'pending'): bool
    {
        $events = [];
        $currentTime = time();

        switch ($initialStatus) {
            case 'collected':
                $events[] = [
                    'tracking_id' => $trackingId,
                    'status' => 'Collected',
                    'description' => 'Item collected from sender',
                    'location' => 'Collection Point',
                    'facility' => 'Local Post Office',
                    'event_date' => date('Y-m-d', $currentTime),
                    'event_time' => date('H:i:s', $currentTime),
                    'icon' => 'fas fa-box',
                    'color' => 'info'
                ];
                break;

            case 'in_transit':
                $events[] = [
                    'tracking_id' => $trackingId,
                    'status' => 'Collected',
                    'description' => 'Item collected from sender',
                    'location' => 'Collection Point',
                    'facility' => 'Local Post Office',
                    'event_date' => date('Y-m-d', $currentTime - 86400),
                    'event_time' => date('H:i:s', $currentTime - 86400),
                    'icon' => 'fas fa-box',
                    'color' => 'info'
                ];
                $events[] = [
                    'tracking_id' => $trackingId,
                    'status' => 'In Transit',
                    'description' => 'Item in transit to destination',
                    'location' => 'Regional Sorting Facility',
                    'facility' => 'Mail Centre',
                    'event_date' => date('Y-m-d', $currentTime),
                    'event_time' => date('H:i:s', $currentTime),
                    'icon' => 'fas fa-shipping-fast',
                    'color' => 'primary'
                ];
                break;

            case 'delivered':
                $events[] = [
                    'tracking_id' => $trackingId,
                    'status' => 'Collected',
                    'description' => 'Item collected from sender',
                    'location' => 'Collection Point',
                    'facility' => 'Local Post Office',
                    'event_date' => date('Y-m-d', $currentTime - 172800),
                    'event_time' => date('H:i:s', $currentTime - 172800),
                    'icon' => 'fas fa-box',
                    'color' => 'info'
                ];
                $events[] = [
                    'tracking_id' => $trackingId,
                    'status' => 'In Transit',
                    'description' => 'Item in transit to destination',
                    'location' => 'Regional Sorting Facility',
                    'facility' => 'Mail Centre',
                    'event_date' => date('Y-m-d', $currentTime - 86400),
                    'event_time' => date('H:i:s', $currentTime - 86400),
                    'icon' => 'fas fa-shipping-fast',
                    'color' => 'primary'
                ];
                $events[] = [
                    'tracking_id' => $trackingId,
                    'status' => 'Out for Delivery',
                    'description' => 'Item out for delivery',
                    'location' => 'Local Delivery Office',
                    'facility' => 'Delivery Office',
                    'event_date' => date('Y-m-d', $currentTime - 3600),
                    'event_time' => date('H:i:s', $currentTime - 3600),
                    'icon' => 'fas fa-truck',
                    'color' => 'info'
                ];
                $events[] = [
                    'tracking_id' => $trackingId,
                    'status' => 'Delivered',
                    'description' => 'Item successfully delivered',
                    'location' => 'Delivery Address',
                    'facility' => 'Customer Address',
                    'event_date' => date('Y-m-d', $currentTime),
                    'event_time' => date('H:i:s', $currentTime),
                    'icon' => 'fas fa-check-circle',
                    'color' => 'success'
                ];
                break;

            default: // pending
                $events[] = [
                    'tracking_id' => $trackingId,
                    'status' => 'Pending',
                    'description' => 'Item ready for collection',
                    'location' => 'Sender Location',
                    'facility' => 'Awaiting Collection',
                    'event_date' => date('Y-m-d', $currentTime),
                    'event_time' => date('H:i:s', $currentTime),
                    'icon' => 'fas fa-clock',
                    'color' => 'warning'
                ];
                break;
        }

        // Insert all events
        foreach ($events as $event) {
            if (!$this->insert($event)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Update timeline when status changes
     */
    public function updateTimelineForStatusChange(int $trackingId, string $newStatus, array $additionalData = []): bool
    {
        $statusDescriptions = [
            'pending' => 'Item ready for collection',
            'collected' => 'Item collected from sender',
            'in_transit' => 'Item in transit to destination',
            'out_for_delivery' => 'Item out for delivery',
            'delivered' => 'Item successfully delivered',
            'failed_delivery' => 'Delivery attempt failed',
            'returned' => 'Item returned to sender'
        ];

        $statusLocations = [
            'pending' => 'Sender Location',
            'collected' => 'Collection Point',
            'in_transit' => 'Regional Sorting Facility',
            'out_for_delivery' => 'Local Delivery Office',
            'delivered' => 'Delivery Address',
            'failed_delivery' => 'Delivery Address',
            'returned' => 'Return Processing Centre'
        ];

        $eventData = [
            'tracking_id' => $trackingId,
            'status' => ucfirst(str_replace('_', ' ', $newStatus)),
            'description' => $statusDescriptions[$newStatus] ?? 'Status updated',
            'location' => $additionalData['location'] ?? $statusLocations[$newStatus] ?? 'Unknown Location',
            'facility' => $additionalData['facility'] ?? 'Processing Facility',
            'notes' => $additionalData['notes'] ?? null
        ];

        return $this->addTimelineEvent($trackingId, $eventData);
    }

    /**
     * Get timeline formatted for display
     */
    public function getFormattedTimeline(int $trackingId): array
    {
        $timeline = $this->getTimelineByTrackingId($trackingId);
        
        foreach ($timeline as &$event) {
            $event['date'] = date('d M Y', strtotime($event['event_date']));
            $event['time'] = date('g:i A', strtotime($event['event_time']));
            $event['datetime'] = $event['date'] . ' at ' . $event['time'];
        }
        
        return $timeline;
    }
}
