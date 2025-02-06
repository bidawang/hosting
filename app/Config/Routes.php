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


