<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('daycare', function($routes) {
    $routes->get('/', 'Daycare::index');
    $routes->get('(:num)', 'Daycare::detail/$1');
});
