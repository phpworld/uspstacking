<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrackingParcelsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tracking_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'collected', 'in_transit', 'out_for_delivery', 'delivered', 'failed_delivery', 'returned'],
                'default'    => 'pending',
            ],
            'service_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'estimated_delivery' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'actual_delivery' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            // Sender Information
            'sender_company' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'sender_contact' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sender_address' => [
                'type' => 'TEXT',
            ],
            'sender_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'sender_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'sender_reference' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            // Receiver Information
            'receiver_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'receiver_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'receiver_address' => [
                'type' => 'TEXT',
            ],
            'receiver_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'receiver_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'receiver_instructions' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // Parcel Information
            'parcel_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'parcel_weight' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'parcel_dimensions' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'parcel_contents' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
            ],
            'parcel_value' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'parcel_insurance' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'parcel_postage' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'signature_required' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            // Location Information
            'current_location' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'current_facility' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'facility_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'distance_from_destination' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'postcode_area' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'delivery_round' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'last_location_update' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            // Additional Information
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('tracking_number');
        $this->forge->addKey('status');
        $this->forge->addKey('service_type');
        $this->forge->addKey('created_at');
        $this->forge->addKey('sender_company');
        $this->forge->addKey('receiver_name');

        $this->forge->createTable('tracking_parcels');
    }

    public function down()
    {
        $this->forge->dropTable('tracking_parcels');
    }
}
