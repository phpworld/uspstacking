<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('track', 'Home::track');
$routes->get('track/(:any)', 'Home::track/$1');
$routes->post('track', 'Home::trackSubmit');
$routes->get('tracking', 'Home::tracking');
$routes->post('tracking', 'Home::trackingSubmit');

// Admin Routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    // Test route (no authentication required)
    $routes->get('test', 'TestController::index');

    // Authentication routes (no filter)
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Protected admin routes (with auth filter)
    $routes->group('', ['filter' => 'adminauth'], function ($routes) {
        $routes->get('/', 'DashboardController::index');
        $routes->get('dashboard', 'DashboardController::index');

        // User management
        $routes->get('users', 'UsersController::index');
        $routes->get('users/create', 'UsersController::create');
        $routes->post('users/store', 'UsersController::store');
        $routes->get('users/edit/(:num)', 'UsersController::edit/$1');
        $routes->post('users/update/(:num)', 'UsersController::update/$1');
        $routes->post('users/delete/(:num)', 'UsersController::delete/$1');

        // Settings
        $routes->get('settings', 'SettingsController::index');
        $routes->post('settings/update', 'SettingsController::update');

        // Tracking Management
        $routes->get('tracking', 'TrackingController::index');
        $routes->get('tracking/create', 'TrackingController::create');
        $routes->post('tracking/store', 'TrackingController::store');
        $routes->get('tracking/view/(:num)', 'TrackingController::view/$1');
        $routes->get('tracking/edit/(:num)', 'TrackingController::edit/$1');
        $routes->post('tracking/update/(:num)', 'TrackingController::update/$1');
        $routes->post('tracking/delete/(:num)', 'TrackingController::delete/$1');
        $routes->post('tracking/updateStatus', 'TrackingController::updateStatus');
        $routes->post('tracking/addTimelineEvent', 'TrackingController::addTimelineEvent');
        $routes->post('tracking/generateNumber', 'TrackingController::generateNumber');
        $routes->get('tracking/export', 'TrackingController::export');
    });
});
