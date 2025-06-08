<?php

namespace App\Controllers\Admin;

class SettingsController extends BaseAdminController
{
    /**
     * Show settings page
     */
    public function index()
    {
        // Only admin and super_admin can access settings
        $redirect = $this->requireRole('admin');
        if ($redirect) return $redirect;

        $this->setPageTitle('System Settings');
        $this->setBreadcrumbs([
            ['title' => 'Dashboard', 'url' => '/admin/dashboard'],
            ['title' => 'Settings', 'url' => '/admin/settings', 'active' => true]
        ]);

        $data = [
            'settings' => $this->getSystemSettings(),
            'validation' => \Config\Services::validation(),
        ];

        return $this->renderView('admin/settings/index', $data);
    }

    /**
     * Update settings
     */
    public function update()
    {
        // Only admin and super_admin can update settings
        $redirect = $this->requireRole('admin');
        if ($redirect) return $redirect;

        $rules = [
            'site_name' => 'required|min_length[3]|max_length[100]',
            'site_email' => 'required|valid_email',
            'timezone' => 'required',
            'date_format' => 'required',
            'items_per_page' => 'required|integer|greater_than[0]|less_than_equal_to[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $settings = [
            'site_name' => $this->request->getPost('site_name'),
            'site_email' => $this->request->getPost('site_email'),
            'site_description' => $this->request->getPost('site_description'),
            'timezone' => $this->request->getPost('timezone'),
            'date_format' => $this->request->getPost('date_format'),
            'items_per_page' => $this->request->getPost('items_per_page'),
            'maintenance_mode' => $this->request->getPost('maintenance_mode') ? 1 : 0,
            'allow_registration' => $this->request->getPost('allow_registration') ? 1 : 0,
            'email_verification' => $this->request->getPost('email_verification') ? 1 : 0,
        ];

        if ($this->saveSystemSettings($settings)) {
            return redirect()->to('/admin/settings')
                           ->with('success', 'Settings updated successfully.');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to update settings.');
        }
    }

    /**
     * Get system settings
     */
    private function getSystemSettings(): array
    {
        // Default settings
        $defaults = [
            'site_name' => 'Admin Panel',
            'site_email' => 'admin@example.com',
            'site_description' => 'Admin panel for managing the application',
            'timezone' => 'UTC',
            'date_format' => 'Y-m-d H:i:s',
            'items_per_page' => 20,
            'maintenance_mode' => 0,
            'allow_registration' => 1,
            'email_verification' => 0,
        ];

        // Try to load from database or config file
        // For now, we'll use defaults. In a real application, you might store these in a database
        $settings = $this->loadSettingsFromFile();
        
        return array_merge($defaults, $settings);
    }

    /**
     * Save system settings
     */
    private function saveSystemSettings(array $settings): bool
    {
        try {
            // Save to a JSON file for simplicity
            // In a real application, you might save to database
            $settingsFile = WRITEPATH . 'settings.json';
            $json = json_encode($settings, JSON_PRETTY_PRINT);
            
            return file_put_contents($settingsFile, $json) !== false;
        } catch (\Exception $e) {
            log_message('error', 'Failed to save settings: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Load settings from file
     */
    private function loadSettingsFromFile(): array
    {
        try {
            $settingsFile = WRITEPATH . 'settings.json';
            
            if (file_exists($settingsFile)) {
                $json = file_get_contents($settingsFile);
                $settings = json_decode($json, true);
                
                return is_array($settings) ? $settings : [];
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to load settings: ' . $e->getMessage());
        }
        
        return [];
    }

    /**
     * Get available timezones
     */
    public function getTimezones(): array
    {
        return [
            'UTC' => 'UTC',
            'America/New_York' => 'Eastern Time',
            'America/Chicago' => 'Central Time',
            'America/Denver' => 'Mountain Time',
            'America/Los_Angeles' => 'Pacific Time',
            'Europe/London' => 'London',
            'Europe/Paris' => 'Paris',
            'Europe/Berlin' => 'Berlin',
            'Asia/Tokyo' => 'Tokyo',
            'Asia/Shanghai' => 'Shanghai',
            'Asia/Kolkata' => 'Kolkata',
            'Australia/Sydney' => 'Sydney',
        ];
    }

    /**
     * Get available date formats
     */
    public function getDateFormats(): array
    {
        return [
            'Y-m-d H:i:s' => date('Y-m-d H:i:s'),
            'd/m/Y H:i:s' => date('d/m/Y H:i:s'),
            'm/d/Y H:i:s' => date('m/d/Y H:i:s'),
            'Y-m-d' => date('Y-m-d'),
            'd/m/Y' => date('d/m/Y'),
            'm/d/Y' => date('m/d/Y'),
        ];
    }
}
