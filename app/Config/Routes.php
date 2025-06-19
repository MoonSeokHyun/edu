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

$routes->get('sitemap', 'SitemapController::index');
$routes->get('sitemap/generate/(:segment)/(:num)', 'SitemapController::generate/$1/$2');
