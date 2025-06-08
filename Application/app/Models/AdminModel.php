<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin_users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'role',
        'status',
        'last_login',
        'login_attempts',
        'locked_until'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'username'   => 'required|min_length[3]|max_length[50]|is_unique[admin_users.username,id,{id}]',
        'email'      => 'required|valid_email|is_unique[admin_users.email,id,{id}]',
        'password'   => 'required|min_length[8]',
        'first_name' => 'required|min_length[2]|max_length[50]',
        'last_name'  => 'required|min_length[2]|max_length[50]',
        'role'       => 'required|in_list[super_admin,admin,moderator]',
        'status'     => 'required|in_list[active,inactive,suspended]',
    ];

    protected $validationMessages = [
        'username' => [
            'required'    => 'Username is required',
            'min_length'  => 'Username must be at least 3 characters long',
            'max_length'  => 'Username cannot exceed 50 characters',
            'is_unique'   => 'Username already exists',
        ],
        'email' => [
            'required'    => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'is_unique'   => 'Email already exists',
        ],
        'password' => [
            'required'   => 'Password is required',
            'min_length' => 'Password must be at least 8 characters long',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    /**
     * Hash password before saving
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Verify admin login credentials
     */
    public function verifyLogin(string $username, string $password): array|false
    {
        $admin = $this->where('username', $username)
                     ->orWhere('email', $username)
                     ->first();

        if (!$admin) {
            return false;
        }

        // Check if account is locked
        if ($admin['locked_until'] && strtotime($admin['locked_until']) > time()) {
            return false;
        }

        // Check if account is active
        if ($admin['status'] !== 'active') {
            return false;
        }

        // Verify password
        if (password_verify($password, $admin['password'])) {
            // Reset login attempts on successful login
            $this->update($admin['id'], [
                'login_attempts' => 0,
                'locked_until' => null,
                'last_login' => date('Y-m-d H:i:s')
            ]);
            
            return $admin;
        }

        // Increment login attempts
        $attempts = $admin['login_attempts'] + 1;
        $updateData = ['login_attempts' => $attempts];

        // Lock account after 3 failed attempts for 30 minutes
        if ($attempts >= 3) {
            $updateData['locked_until'] = date('Y-m-d H:i:s', time() + (30 * 60));
        }

        $this->update($admin['id'], $updateData);
        return false;
    }

    /**
     * Get admin by ID without password
     */
    public function getAdminById(int $id): array|null
    {
        return $this->select('id, username, email, first_name, last_name, role, status, last_login, created_at')
                   ->find($id);
    }

    /**
     * Get all admins without passwords
     */
    public function getAllAdmins(): array
    {
        return $this->select('id, username, email, first_name, last_name, role, status, last_login, created_at')
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }
}
