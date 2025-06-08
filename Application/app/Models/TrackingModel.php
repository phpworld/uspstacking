<?php

namespace App\Models;

use CodeIgniter\Model;

class TrackingModel extends Model
{
    protected $table            = 'tracking_parcels';
    protected $errors           = [];
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tracking_number',
        'status',
        'service_type',
        'estimated_delivery',
        'actual_delivery',
        'sender_company',
        'sender_contact',
        'sender_address',
        'sender_phone',
        'sender_email',
        'sender_reference',
        'receiver_name',
        'receiver_title',
        'receiver_address',
        'receiver_phone',
        'receiver_email',
        'receiver_instructions',
        'parcel_type',
        'parcel_weight',
        'parcel_dimensions',
        'parcel_contents',
        'parcel_value',
        'parcel_insurance',
        'parcel_postage',
        'signature_required',
        'current_location',
        'current_facility',
        'facility_address',
        'distance_from_destination',
        'postcode_area',
        'delivery_round',
        'last_location_update',
        'notes',
        'created_by',
        'updated_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'tracking_number'    => 'required|min_length[10]|max_length[20]',
        'status'            => 'required|in_list[pending,collected,in_transit,out_for_delivery,delivered,failed_delivery,returned]',
        'service_type'      => 'required|max_length[100]',
        'sender_company'    => 'required|max_length[200]',
        'sender_contact'    => 'required|max_length[100]',
        'sender_address'    => 'required',
        'sender_phone'      => 'permit_empty|max_length[20]',
        'sender_email'      => 'permit_empty|valid_email',
        'receiver_name'     => 'required|max_length[100]',
        'receiver_address'  => 'required',
        'receiver_phone'    => 'permit_empty|max_length[20]',
        'receiver_email'    => 'permit_empty|valid_email',
        'parcel_type'       => 'required|max_length[50]',
        'parcel_weight'     => 'permit_empty|max_length[20]',
        'parcel_contents'   => 'required|max_length[500]',
        'signature_required' => 'required|in_list[0,1]',
        'current_location'  => 'permit_empty|max_length[200]',
        'current_facility'  => 'permit_empty|max_length[200]',
    ];

    protected $validationMessages = [
        'tracking_number' => [
            'required'    => 'Tracking number is required',
            'min_length'  => 'Tracking number must be at least 10 characters',
            'max_length'  => 'Tracking number cannot exceed 20 characters',
            'is_unique'   => 'This tracking number already exists'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list'  => 'Invalid status selected'
        ]
    ];

    /**
     * Get tracking data by tracking number
     */
    public function getByTrackingNumber(string $trackingNumber): ?array
    {
        return $this->where('tracking_number', strtoupper($trackingNumber))->first();
    }

    /**
     * Get all tracking records with pagination
     */
    public function getTrackingList(int $limit = 20, int $offset = 0, array $filters = []): array
    {
        $builder = $this->builder();

        // Apply filters
        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        if (!empty($filters['service_type'])) {
            $builder->like('service_type', $filters['service_type']);
        }

        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('tracking_number', $filters['search'])
                ->orLike('sender_company', $filters['search'])
                ->orLike('receiver_name', $filters['search'])
                ->groupEnd();
        }

        if (!empty($filters['date_from'])) {
            $builder->where('created_at >=', $filters['date_from'] . ' 00:00:00');
        }

        if (!empty($filters['date_to'])) {
            $builder->where('created_at <=', $filters['date_to'] . ' 23:59:59');
        }

        return $builder->orderBy('created_at', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->getResultArray();
    }

    /**
     * Get tracking count with filters
     */
    public function getTrackingCount(array $filters = []): int
    {
        $builder = $this->builder();

        // Apply same filters as getTrackingList
        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        if (!empty($filters['service_type'])) {
            $builder->like('service_type', $filters['service_type']);
        }

        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('tracking_number', $filters['search'])
                ->orLike('sender_company', $filters['search'])
                ->orLike('receiver_name', $filters['search'])
                ->groupEnd();
        }

        if (!empty($filters['date_from'])) {
            $builder->where('created_at >=', $filters['date_from'] . ' 00:00:00');
        }

        if (!empty($filters['date_to'])) {
            $builder->where('created_at <=', $filters['date_to'] . ' 23:59:59');
        }

        return $builder->countAllResults();
    }

    /**
     * Get status statistics
     */
    public function getStatusStats(): array
    {
        $builder = $this->builder();
        $results = $builder->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->getResultArray();

        $stats = [
            'pending' => 0,
            'collected' => 0,
            'in_transit' => 0,
            'out_for_delivery' => 0,
            'delivered' => 0,
            'failed_delivery' => 0,
            'returned' => 0
        ];

        foreach ($results as $result) {
            $stats[$result['status']] = (int)$result['count'];
        }

        return $stats;
    }

    /**
     * Generate unique tracking number
     */
    public function generateTrackingNumber(string $prefix = 'RM'): string
    {
        do {
            $trackingNumber = $prefix . str_pad(mt_rand(1, 999999999), 9, '0', STR_PAD_LEFT) . 'GB';
        } while ($this->getByTrackingNumber($trackingNumber) !== null);

        return $trackingNumber;
    }

    /**
     * Update tracking status
     */
    public function updateStatus(int $id, string $status, array $additionalData = []): bool
    {
        $updateData = array_merge(['status' => $status], $additionalData);

        if ($status === 'delivered' && empty($additionalData['actual_delivery'])) {
            $updateData['actual_delivery'] = date('Y-m-d H:i:s');
        }

        return $this->update($id, $updateData);
    }

    /**
     * Get available statuses
     */
    public function getAvailableStatuses(): array
    {
        return [
            'pending' => 'Pending Collection',
            'collected' => 'Collected',
            'in_transit' => 'In Transit',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered',
            'failed_delivery' => 'Failed Delivery',
            'returned' => 'Returned to Sender'
        ];
    }

    /**
     * Get available service types
     */
    public function getAvailableServiceTypes(): array
    {
        return [
            'First Class' => 'First Class',
            'Second Class' => 'Second Class',
            'Special Delivery Guaranteed' => 'Special Delivery Guaranteed',
            'Special Delivery Guaranteed by 9am' => 'Special Delivery Guaranteed by 9am',
            'Special Delivery Guaranteed by 1pm' => 'Special Delivery Guaranteed by 1pm',
            'Signed For' => 'Signed For',
            'International Standard' => 'International Standard',
            'International Tracked' => 'International Tracked',
            'International Signed' => 'International Signed'
        ];
    }

    /**
     * Get available parcel types
     */
    public function getAvailableParcelTypes(): array
    {
        return [
            'Letter' => 'Letter',
            'Large Letter' => 'Large Letter',
            'Small Parcel' => 'Small Parcel',
            'Medium Parcel' => 'Medium Parcel',
            'Large Parcel' => 'Large Parcel',
            'Extra Large Parcel' => 'Extra Large Parcel',
            'Document' => 'Document',
            'Fragile Item' => 'Fragile Item',
            'Valuable Item' => 'Valuable Item'
        ];
    }

    /**
     * Validate data for creating new tracking record
     */
    public function validateForCreate(array $data): bool
    {
        $rules = $this->validationRules;
        $rules['tracking_number'] .= '|is_unique[tracking_parcels.tracking_number]';

        $validation = \Config\Services::validation();
        $validation->setRules($rules, $this->validationMessages);

        $result = $validation->run($data);

        if (!$result) {
            $this->errors = $validation->getErrors();
        }

        return $result;
    }

    /**
     * Validate data for updating existing tracking record
     */
    public function validateForUpdate(array $data, int $id): bool
    {
        $rules = $this->validationRules;
        $rules['tracking_number'] .= '|is_unique[tracking_parcels.tracking_number,id,' . $id . ']';

        $validation = \Config\Services::validation();
        $validation->setRules($rules, $this->validationMessages);

        $result = $validation->run($data);

        if (!$result) {
            $this->errors = $validation->getErrors();
        }

        return $result;
    }

    /**
     * Get validation errors
     */
    public function getValidationErrors(): array
    {
        $validation = \Config\Services::validation();
        return $validation->getErrors();
    }

    /**
     * Save with proper validation
     */
    public function saveWithValidation(array $data, ?int $id = null): bool
    {
        if ($id === null) {
            // Creating new record
            if (!$this->validateForCreate($data)) {
                return false;
            }
        } else {
            // Updating existing record
            if (!$this->validateForUpdate($data, $id)) {
                return false;
            }
        }

        if ($id === null) {
            return $this->insert($data) !== false;
        } else {
            return $this->update($id, $data);
        }
    }
}
