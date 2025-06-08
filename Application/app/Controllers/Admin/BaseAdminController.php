<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class BaseAdminController extends BaseController
{
    protected $adminModel;
    protected $session;
    protected $currentAdmin;
    protected $viewData = [];

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->adminModel = new AdminModel();
        $this->session = session();

        // Load current admin data if logged in
        if ($this->session->get('admin_logged_in')) {
            $adminId = $this->session->get('admin_id');
            try {
                $this->currentAdmin = $this->adminModel->getAdminById($adminId);
            } catch (\Exception $e) {
                log_message('error', 'Error loading admin data: ' . $e->getMessage());
                $this->currentAdmin = null;
            }
        }

        // Set common view data
        $this->setViewData();
    }

    /**
     * Set common data for all admin views
     */
    protected function setViewData()
    {
        // Store common data in class properties for use in renderView
        $this->viewData = [
            'currentAdmin' => $this->currentAdmin,
            'pageTitle' => 'Admin Panel',
            'breadcrumbs' => [],
        ];
    }

    /**
     * Check if current admin has required role
     */
    protected function hasRole(string $role): bool
    {
        if (!$this->currentAdmin) {
            return false;
        }

        $roleHierarchy = [
            'super_admin' => 3,
            'admin' => 2,
            'moderator' => 1,
        ];

        $currentRoleLevel = $roleHierarchy[$this->currentAdmin['role']] ?? 0;
        $requiredRoleLevel = $roleHierarchy[$role] ?? 0;

        return $currentRoleLevel >= $requiredRoleLevel;
    }

    /**
     * Require specific role or redirect
     */
    protected function requireRole(string $role, string $message = 'Access denied. Insufficient permissions.')
    {
        if (!$this->hasRole($role)) {
            return redirect()->back()->with('error', $message);
        }
    }

    /**
     * Set page title
     */
    protected function setPageTitle(string $title)
    {
        $this->viewData['pageTitle'] = $title . ' - Admin Panel';
    }

    /**
     * Set breadcrumbs
     */
    protected function setBreadcrumbs(array $breadcrumbs)
    {
        $this->viewData['breadcrumbs'] = $breadcrumbs;
    }

    /**
     * Render admin view with layout
     */
    protected function renderView(string $view, array $data = [])
    {
        // Merge view data with passed data
        $mergedData = array_merge($this->viewData, $data);
        $mergedData['content'] = view($view, $mergedData);
        return view('admin/layout/main', $mergedData);
    }

    /**
     * JSON response helper
     */
    protected function jsonResponse(array $data, int $statusCode = 200)
    {
        return $this->response
            ->setStatusCode($statusCode)
            ->setJSON($data);
    }

    /**
     * Success response helper
     */
    protected function successResponse(string $message, array $data = [])
    {
        return $this->jsonResponse([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * Error response helper
     */
    protected function errorResponse(string $message, array $errors = [], int $statusCode = 400)
    {
        return $this->jsonResponse([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
}
