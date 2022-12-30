<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::index');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/verify', 'AuthController::verify');

$routes->group('/alumni', ['filter' => 'alumnifilter'], function (RouteCollection $routes) {
    $routes->get('', 'Alumni\AlumniController::dashboard');

    $routes->group('profile', function (RouteCollection $routes) {
        $routes->get('', 'Alumni\AlumniController::profilePage');
        $routes->post('save', 'Alumni\AlumniController::profileSave');
    });

    $routes->group('loker', function (RouteCollection $routes) {
        $routes->get('', 'Alumni\AlumniController::lokerPage');
    });
});

$routes->group('/admin', ['filter' => 'adminfilter'], function (RouteCollection $routes) {
    $routes->get('', 'Admin\DashboardController::dashboard');
    $routes->group('profile', function (RouteCollection $routes) {
        $routes->get('', 'Admin\ProfileController::index');
        $routes->post('save', 'Admin\ProfileController::save');
    });

    $routes->group('alumni', function (RouteCollection $routes) {
        $routes->get('', 'Admin\AlumniController::manage');
        $routes->get('create', 'Admin\AlumniController::create');
        $routes->get("store", 'Admin\AlumniController::store');
        $routes->post("save", 'Admin\AlumniController::save');
        $routes->post("getall", "Admin\AlumniController::getdata");
        $routes->post('trash', 'Admin\AlumniController::trash');
        $routes->post("store", 'Admin\AlumniController::process_store');
        $routes->post("download", "Admin\AlumniController::download");
    });

    $routes->group('jurusan', function (RouteCollection $routes) {
        $routes->get('', 'Admin\JurusanController::manage');
        $routes->post('save', 'Admin\JurusanController::save');
        $routes->post('getall', 'Admin\JurusanController::getAll');
    });

    $routes->group('loker', function (RouteCollection $routes) {
        $routes->get('', 'Admin\LokerController::manage');
        $routes->get('create', 'Admin\LokerController::create');
        $routes->get('store', 'Admin\LokerController::store');
        $routes->post("save", "Admin\LokerController::save");
        $routes->post('getall', 'Admin\LokerController::getAll');
        $routes->post("store", 'Admin\LokerController::process_store');
        $routes->post("download", 'Admin\LokerController::download');
    });

    $routes->group('school', function (RouteCollection $routes) {
        $routes->get('', "Admin\SchoolController::index");
        $routes->post('save', 'Admin\SchoolController::save');
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
