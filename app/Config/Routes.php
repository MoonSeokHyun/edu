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

$routes->group('academy', function($routes) {
    $routes->get('/', 'Academy::index');
    $routes->get('(:segment)', 'Academy::detail/$1');
});

$routes->get('sitemap', 'SitemapController::index');
$routes->get('sitemap/static', 'SitemapController::static');
$routes->get('sitemap/generate/(:segment)/(:num)', 'SitemapController::generate/$1/$2');
