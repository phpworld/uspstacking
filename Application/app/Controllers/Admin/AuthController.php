<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AuthController extends BaseController
{
    protected $adminModel;
    protected $session;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        $this->adminModel = new AdminModel();
        $this->session = session();
    }

    /**
     * Show login form
     */
    public function login()
    {
        // Redirect if already logged in
        if ($this->session->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'pageTitle' => 'Admin Login',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/auth/login', $data);
    }

    /**
     * Process login attempt
     */
    public function attemptLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        // Attempt to verify login
        $admin = $this->adminModel->verifyLogin($username, $password);

        if (!$admin) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Invalid username/email or password. Account may be locked after 3 failed attempts.');
        }

        // Set session data
        $sessionData = [
            'admin_id' => $admin['id'],
            'admin_username' => $admin['username'],
            'admin_email' => $admin['email'],
            'admin_role' => $admin['role'],
            'admin_logged_in' => true,
            'admin_last_activity' => time(),
        ];

        $this->session->set($sessionData);

        // Set remember me cookie if requested
        if ($remember) {
            $cookieValue = base64_encode($admin['id'] . ':' . $admin['username']);
            setcookie('admin_remember', $cookieValue, time() + (30 * 24 * 60 * 60), '/'); // 30 days
        }

        // Redirect to intended page or dashboard
        $redirectTo = $this->session->get('admin_redirect_url') ?: '/admin/dashboard';
        $this->session->remove('admin_redirect_url');

        return redirect()->to($redirectTo)->with('success', 'Welcome back, ' . $admin['first_name'] . '!');
    }

    /**
     * Logout admin
     */
    public function logout()
    {
        // Remove admin session data
        $this->session->remove([
            'admin_id',
            'admin_username',
            'admin_email',
            'admin_role',
            'admin_logged_in',
            'admin_last_activity',
        ]);

        // Remove remember me cookie
        setcookie('admin_remember', '', time() - 3600, '/');

        // Destroy session if no other data
        if (empty($this->session->get())) {
            $this->session->destroy();
        }

        return redirect()->to('/admin/login')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Check remember me cookie and auto-login
     */
    private function checkRememberMe()
    {
        if (isset($_COOKIE['admin_remember']) && !$this->session->get('admin_logged_in')) {
            $cookieValue = base64_decode($_COOKIE['admin_remember']);
            $parts = explode(':', $cookieValue);

            if (count($parts) === 2) {
                $adminId = $parts[0];
                $username = $parts[1];

                $admin = $this->adminModel->where('id', $adminId)
                                         ->where('username', $username)
                                         ->where('status', 'active')
                                         ->first();

                if ($admin) {
                    // Auto-login
                    $sessionData = [
                        'admin_id' => $admin['id'],
                        'admin_username' => $admin['username'],
                        'admin_email' => $admin['email'],
                        'admin_role' => $admin['role'],
                        'admin_logged_in' => true,
                        'admin_last_activity' => time(),
                    ];

                    $this->session->set($sessionData);
                    return true;
                }
            }

            // Invalid cookie, remove it
            setcookie('admin_remember', '', time() - 3600, '/');
        }

        return false;
    }
}
