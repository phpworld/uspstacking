<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if admin is logged in
        if (!$session->get('admin_logged_in')) {
            // Redirect to admin login page
            return redirect()->to('/admin/login')->with('error', 'Please login to access admin panel.');
        }
        
        // Check if admin session is still valid
        $adminId = $session->get('admin_id');
        if (!$adminId) {
            $session->destroy();
            return redirect()->to('/admin/login')->with('error', 'Session expired. Please login again.');
        }
        
        // Optional: Check if admin user still exists and is active
        $adminModel = new \App\Models\AdminModel();
        $admin = $adminModel->find($adminId);
        
        if (!$admin || $admin['status'] !== 'active') {
            $session->destroy();
            return redirect()->to('/admin/login')->with('error', 'Account is inactive or does not exist.');
        }
        
        // Update last activity
        $session->set('admin_last_activity', time());
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do here
    }
}
