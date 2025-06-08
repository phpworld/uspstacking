<?php

namespace App\Controllers\Admin;

class DashboardController extends BaseAdminController
{
    /**
     * Admin dashboard
     */
    public function index()
    {
        $this->setPageTitle('Dashboard');
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard', 'active' => true]
        ]);

        // Get dashboard statistics
        $stats = $this->getDashboardStats();

        $data = [
            'stats' => $stats,
            'recentActivity' => $this->getRecentActivity(),
            'systemInfo' => $this->getSystemInfo(),
        ];

        return $this->renderView('admin/dashboard/index', $data);
    }

    /**
     * Get dashboard statistics
     */
    private function getDashboardStats(): array
    {
        $stats = [
            'total_admins' => 0,
            'active_admins' => 0,
            'recent_logins' => 0,
            'system_uptime' => '99.9%'
        ];

        try {
            // Total admin users
            $stats['total_admins'] = $this->adminModel->countAll();

            // Active admin users
            $stats['active_admins'] = $this->adminModel->where('status', 'active')->countAllResults();

            // Recent logins (last 24 hours)
            $stats['recent_logins'] = $this->adminModel
                ->where('last_login >=', date('Y-m-d H:i:s', time() - (24 * 60 * 60)))
                ->countAllResults();
        } catch (\Exception $e) {
            log_message('error', 'Dashboard stats error: ' . $e->getMessage());
            // Return default values if database error occurs
        }

        return $stats;
    }

    /**
     * Get recent activity
     */
    private function getRecentActivity(): array
    {
        $activity = [];

        try {
            // Get recent admin logins
            $recentLogins = $this->adminModel
                ->select('username, first_name, last_name, last_login')
                ->where('last_login IS NOT NULL')
                ->orderBy('last_login', 'DESC')
                ->limit(10)
                ->findAll();

            foreach ($recentLogins as $login) {
                $activity[] = [
                    'type' => 'login',
                    'message' => $login['first_name'] . ' ' . $login['last_name'] . ' logged in',
                    'username' => $login['username'],
                    'timestamp' => $login['last_login'],
                    'icon' => 'fas fa-sign-in-alt',
                    'color' => 'success'
                ];
            }

            // Sort by timestamp
            usort($activity, function ($a, $b) {
                return strtotime($b['timestamp']) - strtotime($a['timestamp']);
            });
        } catch (\Exception $e) {
            log_message('error', 'Dashboard activity error: ' . $e->getMessage());
            // Return empty array if database error occurs
        }

        return array_slice($activity, 0, 10);
    }

    /**
     * Get system information
     */
    private function getSystemInfo(): array
    {
        return [
            'php_version' => PHP_VERSION,
            'codeigniter_version' => \CodeIgniter\CodeIgniter::CI_VERSION,
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'database_version' => $this->getDatabaseVersion(),
            'memory_usage' => $this->formatBytes(memory_get_usage(true)),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time') . 's',
            'upload_max_filesize' => ini_get('upload_max_filesize'),
        ];
    }

    /**
     * Get database version
     */
    private function getDatabaseVersion(): string
    {
        try {
            $db = \Config\Database::connect();
            $version = $db->getVersion();
            return $version;
        } catch (\Exception $e) {
            log_message('error', 'Database version error: ' . $e->getMessage());
            return 'Unknown';
        }
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
