<?php

namespace App\Controllers;

use App\Models\TrackingModel;
use App\Models\TrackingTimelineModel;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'pageTitle' => 'Home | Royal Mail Group Ltd',
            'metaDescription' => 'Send letters and parcels with Royal Mail. Track your delivery, find prices and book collections.',
        ];

        return view('home/index', $data);
    }

    public function track($trackingNumber = null): string
    {
        // Clean tracking number if provided
        if ($trackingNumber) {
            $trackingNumber = strtoupper(trim($trackingNumber));
        }

        $data = [
            'pageTitle' => 'Track Your Item | Royal Mail Group Ltd',
            'metaDescription' => 'Track your Royal Mail delivery with our tracking service.',
            'trackingNumber' => $trackingNumber,
            'trackingData' => $this->getTrackingData($trackingNumber),
        ];

        return view('home/track', $data);
    }

    public function trackSubmit()
    {
        $trackingNumber = $this->request->getPost('tracking_number');

        if (empty($trackingNumber)) {
            return redirect()->to('/track')->with('error', 'Please enter a tracking number.');
        }

        // Validate tracking number format
        if (!preg_match('/^[A-Za-z0-9]{10,20}$/', $trackingNumber)) {
            return redirect()->to('/track')->with('error', 'Invalid tracking number format. Please enter 10-20 alphanumeric characters.');
        }

        // Clean the tracking number
        $trackingNumber = strtoupper(trim($trackingNumber));

        return redirect()->to('/track/' . $trackingNumber);
    }

    public function tracking(): string
    {
        $data = [
            'pageTitle' => 'Track Your Package | USPS',
            'metaDescription' => 'Track your USPS package with our comprehensive tracking service.',
        ];

        return view('home/tracking', $data);
    }

    public function trackingSubmit()
    {
        $trackingNumber = $this->request->getPost('trackingNumbers');

        if (empty($trackingNumber)) {
            return redirect()->to('/tracking')->with('error', 'Please enter a tracking number.');
        }

        // Clean the tracking number
        $trackingNumber = strtoupper(trim($trackingNumber));

        // For demo purposes, we'll show the tracking results on the same page
        $data = [
            'pageTitle' => 'Track Your Package | USPS',
            'metaDescription' => 'Track your USPS package with our comprehensive tracking service.',
            'trackingNumber' => $trackingNumber,
            'showResults' => true,
            'trackingData' => $this->getUSPSTrackingData($trackingNumber),
        ];

        return view('home/tracking', $data);
    }

    /**
     * Get tracking data from database
     */
    private function getTrackingData($trackingNumber)
    {
        if (empty($trackingNumber)) {
            return null;
        }

        $trackingModel = new TrackingModel();
        $timelineModel = new TrackingTimelineModel();

        // Get tracking record from database
        $tracking = $trackingModel->getByTrackingNumber($trackingNumber);

        if (!$tracking) {
            // Return null if not found in database (no dummy data)
            return null;
        }

        // Get timeline events
        $timeline = $timelineModel->getFormattedTimeline($tracking['id']);

        // Format data for display
        $statusColors = [
            'pending' => 'warning',
            'collected' => 'info',
            'in_transit' => 'primary',
            'out_for_delivery' => 'info',
            'delivered' => 'success',
            'failed_delivery' => 'danger',
            'returned' => 'secondary'
        ];

        return [
            'tracking_number' => $tracking['tracking_number'],
            'status' => ucfirst(str_replace('_', ' ', $tracking['status'])),
            'status_class' => $statusColors[$tracking['status']] ?? 'secondary',
            'service_type' => $tracking['service_type'],
            'estimated_delivery' => $tracking['estimated_delivery'] ? date('d M Y', strtotime($tracking['estimated_delivery'])) : 'TBC',
            'sender' => [
                'company' => $tracking['sender_company'],
                'contact' => $tracking['sender_contact'],
                'address' => $tracking['sender_address'],
                'phone' => $tracking['sender_phone'] ?: 'Not provided',
                'email' => $tracking['sender_email'] ?: 'Not provided',
                'reference' => $tracking['sender_reference'] ?: 'Not provided'
            ],
            'receiver' => [
                'name' => ($tracking['receiver_title'] ? $tracking['receiver_title'] . ' ' : '') . $tracking['receiver_name'],
                'title' => $tracking['receiver_title'] ?: '',
                'address' => $tracking['receiver_address'],
                'phone' => $tracking['receiver_phone'] ?: 'Not provided',
                'email' => $tracking['receiver_email'] ?: 'Not provided',
                'instructions' => $tracking['receiver_instructions'] ?: 'None'
            ],
            'parcel' => [
                'type' => $tracking['parcel_type'],
                'weight' => $tracking['parcel_weight'] ?: 'Not specified',
                'dimensions' => $tracking['parcel_dimensions'] ?: 'Not specified',
                'contents' => $tracking['parcel_contents'],
                'value' => $tracking['parcel_value'] ? '£' . number_format($tracking['parcel_value'], 2) : 'Not declared',
                'insurance' => $tracking['parcel_insurance'] ? '£' . number_format($tracking['parcel_insurance'], 2) : 'None',
                'postage' => $tracking['parcel_postage'] ? '£' . number_format($tracking['parcel_postage'], 2) : 'Not specified',
                'signature_required' => (bool)$tracking['signature_required']
            ],
            'location' => [
                'current' => $tracking['current_location'] ?: 'In transit',
                'facility' => $tracking['current_facility'] ?: 'Processing facility',
                'address' => $tracking['facility_address'] ?: 'Various locations',
                'distance' => $tracking['distance_from_destination'] ?: 'Calculating...',
                'postcode_area' => $tracking['postcode_area'] ?: 'Multiple areas',
                'delivery_round' => $tracking['delivery_round'] ?: 'TBC',
                'last_updated' => $tracking['last_location_update'] ? date('d M Y H:i', strtotime($tracking['last_location_update'])) : date('d M Y H:i', strtotime($tracking['updated_at']))
            ],
            'timeline' => $timeline
        ];
    }

    /**
     * Get USPS tracking data from database only (no dummy data)
     */
    private function getUSPSTrackingData($trackingNumber)
    {
        if (empty($trackingNumber)) {
            return null;
        }

        $trackingModel = new TrackingModel();
        $timelineModel = new TrackingTimelineModel();

        // Get tracking record from database
        $tracking = $trackingModel->getByTrackingNumber($trackingNumber);

        if (!$tracking) {
            // Return null if not found in database (no dummy data)
            return null;
        }

        // Get timeline events
        $timeline = $timelineModel->getFormattedTimeline($tracking['id']);

        // Format timeline for USPS display
        $formattedTimeline = [];
        foreach ($timeline as $event) {
            $statusColors = [
                'pending' => 'bg-warning',
                'collected' => 'bg-info',
                'in_transit' => 'bg-primary',
                'out_for_delivery' => 'bg-info',
                'delivered' => 'bg-success',
                'failed_delivery' => 'bg-danger',
                'returned' => 'bg-secondary'
            ];

            $formattedTimeline[] = [
                'status' => ucfirst(str_replace('_', ' ', $event['status'])),
                'description' => $event['description'],
                'date' => date('F j, Y, g:i a', strtotime($event['created_at'])),
                'marker_class' => $statusColors[$event['status']] ?? 'bg-secondary'
            ];
        }

        // Format data for USPS tracking display
        $statusColors = [
            'pending' => 'warning',
            'collected' => 'info',
            'in_transit' => 'primary',
            'out_for_delivery' => 'info',
            'delivered' => 'success',
            'failed_delivery' => 'danger',
            'returned' => 'secondary'
        ];

        return [
            'tracking_number' => $tracking['tracking_number'],
            'status' => ucfirst(str_replace('_', ' ', $tracking['status'])),
            'status_class' => $statusColors[$tracking['status']] ?? 'secondary',
            'service_type' => $tracking['service_type'],
            'delivery_date' => $tracking['estimated_delivery'] ? date('F j, Y, g:i a', strtotime($tracking['estimated_delivery'])) : 'TBC',
            'delivery_location' => $tracking['receiver_address'] ?? 'TBC',
            'sender' => [
                'company' => $tracking['sender_company'] ?? 'Not provided',
                'contact' => $tracking['sender_contact'] ?? 'Not provided',
                'address' => $tracking['sender_address'] ?? 'Not provided',
                'phone' => $tracking['sender_phone'] ?? 'Not provided',
                'email' => $tracking['sender_email'] ?? 'Not provided',
                'reference' => $tracking['sender_reference'] ?? 'Not provided'
            ],
            'receiver' => [
                'name' => ($tracking['receiver_title'] ? $tracking['receiver_title'] . ' ' : '') . ($tracking['receiver_name'] ?? 'Not provided'),
                'title' => $tracking['receiver_title'] ?? '',
                'address' => $tracking['receiver_address'] ?? 'Not provided',
                'phone' => $tracking['receiver_phone'] ?? 'Not provided',
                'email' => $tracking['receiver_email'] ?? 'Not provided',
                'instructions' => $tracking['receiver_instructions'] ?? 'None'
            ],
            'parcel' => [
                'type' => $tracking['parcel_type'] ?? 'Not specified',
                'weight' => $tracking['parcel_weight'] ?? 'Not specified',
                'dimensions' => $tracking['parcel_dimensions'] ?? 'Not specified',
                'contents' => $tracking['parcel_contents'] ?? 'Not specified',
                'value' => $tracking['parcel_value'] ? '$' . number_format($tracking['parcel_value'], 2) : 'Not declared',
                'insurance' => $tracking['parcel_insurance'] ? '$' . number_format($tracking['parcel_insurance'], 2) : 'None',
                'postage' => $tracking['parcel_postage'] ? '$' . number_format($tracking['parcel_postage'], 2) : 'Not specified',
                'signature_required' => (bool)($tracking['signature_required'] ?? false)
            ],
            'location' => [
                'current' => $tracking['current_location'] ?? 'In transit',
                'facility' => $tracking['current_facility'] ?? 'Processing facility',
                'address' => $tracking['facility_address'] ?? 'Various locations',
                'distance' => $tracking['distance_from_destination'] ?? 'Calculating...',
                'postcode_area' => $tracking['postcode_area'] ?? 'Multiple areas',
                'delivery_round' => $tracking['delivery_round'] ?? 'TBC',
                'last_updated' => $tracking['last_location_update'] ? date('F j, Y, g:i A', strtotime($tracking['last_location_update'])) : date('F j, Y, g:i A', strtotime($tracking['updated_at']))
            ],
            'timeline' => $formattedTimeline
        ];
    }
}
