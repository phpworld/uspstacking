<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrackingTimelineTable extends Migration
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
            'tracking_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
            ],
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'facility' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'event_date' => [
                'type' => 'DATE',
            ],
            'event_time' => [
                'type' => 'TIME',
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'color' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
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
        $this->forge->addKey('tracking_id');
        $this->forge->addKey(['event_date', 'event_time']);
        $this->forge->addKey('status');

        // Foreign key constraint
        $this->forge->addForeignKey('tracking_id', 'tracking_parcels', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('tracking_timeline');
    }

    public function down()
    {
        $this->forge->dropTable('tracking_timeline');
    }
}
