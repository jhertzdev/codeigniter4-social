<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);

// Custom Auth Routes
$routes->get('login', 'AuthController::loginView');
$routes->post('login', 'AuthController::loginAction');
$routes->get('register', 'AuthController::registerView');
$routes->post('register', 'AuthController::registerAction');
$routes->get('logout', 'AuthController::logoutAction');

$routes->get('auth/login/(:segment)', 'OAuth::redirect/$1');
$routes->get('auth/callback/(:segment)', 'OAuth::callback/$1');
$routes->get('auth/social-login', 'OAuth::socialLogin');