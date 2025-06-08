<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class TestController extends BaseController
{
    /**
     * Simple test page to verify admin panel is working
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Admin Test - Admin Panel',
            'currentAdmin' => [
                'id' => 1,
                'username' => 'test',
                'first_name' => 'Test',
                'last_name' => 'User',
                'role' => 'admin'
            ],
            'breadcrumbs' => [
                ['title' => 'Test', 'url' => '/admin/test', 'active' => true]
            ]
        ];

        $data['content'] = view('admin/test/index', $data);
        return view('admin/layout/main', $data);
    }
}
