<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //untuk free user
$routes->get('/', 'PaketController::index');
$routes->get('hosting', 'PaketController::hosting');
$routes->get('domain', 'Home::domain');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');

//login dan register
$routes->get('register', 'UserController::register');
$routes->post('register', 'UserController::store');
$routes->get('login', 'UserController::login');
$routes->post('login', 'UserController::authenticate');
$routes->get('logout', 'UserController::logout'); // Add logout route

//mulai masuk ke subscribtion
$routes->get('/a(:num)', 'PaketController::verifikasi/$1'); // Route for verification
$routes->post('confirm', 'PaketController::confirm'); // Route for order confirmation

//route ke admin
$routes->get('admin', 'UserController::admin');

$routes->group('admin', ['filter'=>'admin'], function($routes){
    $routes->get('dashboard', 'SubscriptionController::index');
});

// tes email
$routes->get('send', 'EmailController::sendEmail');
$routes->get('cek-expired', 'SubscriptionController::checkExpirationDates');



//Storage
$routes->group('storage', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'StorageController::index');
    $routes->get('create', 'StorageController::create');
    $routes->post('store', 'StorageController::store');
    $routes->get('edit/(:num)', 'StorageController::edit/$1');
    $routes->post('update/(:num)', 'StorageController::update/$1');
    $routes->get('delete/(:num)', 'StorageController::delete/$1');
});

//Kategori
$routes->group('kategori', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'KategoriController::index');
    $routes->get('create', 'KategoriController::create');
    $routes->post('store', 'KategoriController::store');
    $routes->get('edit/(:num)', 'KategoriController::edit/$1');
    $routes->post('update/(:num)', 'KategoriController::update/$1');
    $routes->get('delete/(:num)', 'KategoriController::delete/$1');
});

//Paket Hosting
$routes->group('paket-hosting', function($routes) {
    $routes->get('/', 'PaketHostingController::index');
    $routes->get('create', 'PaketHostingController::create');
    $routes->post('store', 'PaketHostingController::store');
    $routes->get('edit/(:num)', 'PaketHostingController::edit/$1');
    $routes->post('update/(:num)', 'PaketHostingController::update/$1');
    $routes->get('delete/(:num)', 'PaketHostingController::delete/$1');
});

//Users
$routes->group('user', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'UserController::index');        // List semua user
    $routes->get('create', 'UserController::create');     // Form tambah user
    $routes->post('store', 'UserController::store');      // Proses simpan user baru
    $routes->get('edit/(:num)', 'UserController::edit/$1');  // Form edit user berdasarkan ID
    $routes->post('update/(:num)', 'UserController::update/$1'); // Proses update user berdasarkan ID
    $routes->get('delete/(:num)', 'UserController::delete/$1');  // Hapus user berdasarkan ID
});

//Subscription
$routes->group('subscription', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'SubscriptionController::index');
    $routes->get('create', 'SubscriptionController::create');
    $routes->post('store', 'SubscriptionController::store');
    $routes->get('edit/(:num)', 'SubscriptionController::edit/$1');
    $routes->post('update/(:num)', 'SubscriptionController::update/$1');
    $routes->get('delete/(:num)', 'SubscriptionController::delete/$1');
    $routes->post('updateStatus/(:num)', 'SubscriptionController::updateStatus/$1');
});

//Client Area
$routes->get('clientarea', 'SubscriptionController::clientarea');

//ControlPanel
$routes->get('/client-area/control-panel/(:num)', 'ControlPanelController::controlPanel/$1');
$routes->post('/client-area/update-control-panel/(:num)', 'ControlPanelController::updateControlPanel/$1'); // Update username & password berdasarkan id_subscribtion
$routes->post('/client-area/login', 'ControlPanelController::login');



