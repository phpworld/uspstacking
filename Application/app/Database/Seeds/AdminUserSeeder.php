<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'   => 'admin',
            'email'      => 'admin@example.com',
            'password'   => password_hash('password123', PASSWORD_DEFAULT),
            'first_name' => 'System',
            'last_name'  => 'Administrator',
            'role'       => 'super_admin',
            'status'     => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Check if admin user already exists
        $builder = $this->db->table('admin_users');
        $existingAdmin = $builder->where('username', 'admin')->get()->getRow();

        if (!$existingAdmin) {
            $builder->insert($data);
            echo "Default admin user created successfully.\n";
            echo "Username: admin\n";
            echo "Password: password123\n";
        } else {
            echo "Default admin user already exists.\n";
        }
    }
}
