<?php

namespace App\Controllers\Admin;

class UsersController extends BaseAdminController
{
    /**
     * List all admin users
     */
    public function index()
    {
        $this->setPageTitle('Admin Users');
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard'],
            ['title' => 'Admin Users', 'url' => '/admin/users', 'active' => true]
        ]);

        $data = [
            'users' => $this->adminModel->getAllAdmins(),
        ];

        return $this->renderView('admin/users/index', $data);
    }

    /**
     * Show create user form
     */
    public function create()
    {
        // Only super_admin and admin can create users
        $redirect = $this->requireRole('admin');
        if ($redirect) return $redirect;

        $this->setPageTitle('Create Admin User');
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard'],
            ['title' => 'Admin Users', 'url' => '/admin/users'],
            ['title' => 'Create User', 'url' => '/admin/users/create', 'active' => true]
        ]);

        $data = [
            'validation' => \Config\Services::validation(),
            'roles' => $this->getAvailableRoles(),
        ];

        return $this->renderView('admin/users/create', $data);
    }

    /**
     * Store new user
     */
    public function store()
    {
        // Only super_admin and admin can create users
        $redirect = $this->requireRole('admin');
        if ($redirect) return $redirect;

        $rules = [
            'username'   => 'required|min_length[3]|max_length[50]|is_unique[admin_users.username]',
            'email'      => 'required|valid_email|is_unique[admin_users.email]',
            'password'   => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name'  => 'required|min_length[2]|max_length[50]',
            'role'       => 'required|in_list[super_admin,admin,moderator]',
            'status'     => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        // Check if current admin can assign the requested role
        $requestedRole = $this->request->getPost('role');
        if (!$this->canAssignRole($requestedRole)) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'You cannot assign this role.');
        }

        $userData = [
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'   => $this->request->getPost('password'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'role'       => $requestedRole,
            'status'     => $this->request->getPost('status'),
        ];

        if ($this->adminModel->insert($userData)) {
            return redirect()->to('/admin/users')
                           ->with('success', 'Admin user created successfully.');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to create admin user.');
        }
    }

    /**
     * Show edit user form
     */
    public function edit($id)
    {
        $user = $this->adminModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')
                           ->with('error', 'User not found.');
        }

        // Check permissions
        if (!$this->canEditUser($user)) {
            return redirect()->to('/admin/users')
                           ->with('error', 'You cannot edit this user.');
        }

        $this->setPageTitle('Edit Admin User');
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard'],
            ['title' => 'Admin Users', 'url' => '/admin/users'],
            ['title' => 'Edit User', 'url' => '/admin/users/edit/' . $id, 'active' => true]
        ]);

        $data = [
            'user' => $user,
            'validation' => \Config\Services::validation(),
            'roles' => $this->getAvailableRoles(),
        ];

        return $this->renderView('admin/users/edit', $data);
    }

    /**
     * Update user
     */
    public function update($id)
    {
        $user = $this->adminModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')
                           ->with('error', 'User not found.');
        }

        // Check permissions
        if (!$this->canEditUser($user)) {
            return redirect()->to('/admin/users')
                           ->with('error', 'You cannot edit this user.');
        }

        $rules = [
            'username'   => "required|min_length[3]|max_length[50]|is_unique[admin_users.username,id,{$id}]",
            'email'      => "required|valid_email|is_unique[admin_users.email,id,{$id}]",
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name'  => 'required|min_length[2]|max_length[50]',
            'role'       => 'required|in_list[super_admin,admin,moderator]',
            'status'     => 'required|in_list[active,inactive,suspended]',
        ];

        // Add password validation only if password is provided
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[8]';
            $rules['confirm_password'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $userData = [
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'role'       => $this->request->getPost('role'),
            'status'     => $this->request->getPost('status'),
        ];

        // Add password if provided
        if ($this->request->getPost('password')) {
            $userData['password'] = $this->request->getPost('password');
        }

        if ($this->adminModel->update($id, $userData)) {
            return redirect()->to('/admin/users')
                           ->with('success', 'Admin user updated successfully.');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to update admin user.');
        }
    }

    /**
     * Delete user
     */
    public function delete($id)
    {
        $user = $this->adminModel->find($id);
        if (!$user) {
            return $this->errorResponse('User not found.', [], 404);
        }

        // Prevent self-deletion
        if ($user['id'] == $this->currentAdmin['id']) {
            return $this->errorResponse('You cannot delete your own account.');
        }

        // Only super_admin can delete other super_admins
        if ($user['role'] === 'super_admin' && !$this->hasRole('super_admin')) {
            return $this->errorResponse('You cannot delete a super admin.');
        }

        if ($this->adminModel->delete($id)) {
            return $this->successResponse('Admin user deleted successfully.');
        } else {
            return $this->errorResponse('Failed to delete admin user.');
        }
    }

    /**
     * Get available roles based on current admin's role
     */
    private function getAvailableRoles(): array
    {
        $roles = [
            'moderator' => 'Moderator',
            'admin' => 'Admin',
        ];

        // Only super_admin can assign super_admin role
        if ($this->hasRole('super_admin')) {
            $roles['super_admin'] = 'Super Admin';
        }

        return $roles;
    }

    /**
     * Check if current admin can assign a specific role
     */
    private function canAssignRole(string $role): bool
    {
        if ($role === 'super_admin') {
            return $this->hasRole('super_admin');
        }

        return $this->hasRole('admin');
    }

    /**
     * Check if current admin can edit a specific user
     */
    private function canEditUser(array $user): bool
    {
        // Super admin can edit anyone
        if ($this->hasRole('super_admin')) {
            return true;
        }

        // Admin can edit moderators and other admins (but not super_admins)
        if ($this->hasRole('admin') && $user['role'] !== 'super_admin') {
            return true;
        }

        // Users can edit themselves
        if ($user['id'] == $this->currentAdmin['id']) {
            return true;
        }

        return false;
    }
}
