<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

global $router;

$router->get('/', 'AuthController::login');
$router->get('/login', 'AuthController::login');
$router->post('/login', 'AuthController::authenticate');
$router->get('/logout', 'AuthController::logout');

$router->get('/products', 'ProductController::index')->middleware('ProductAuthMiddleware');
$router->get('/products/create', 'ProductController::create')->middleware('ProductAuthMiddleware');
$router->post('/products', 'ProductController::store')->middleware('ProductAuthMiddleware');
$router->get('/products/edit/{id}', 'ProductController::edit')->middleware('ProductAuthMiddleware');
$router->post('/products/edit/{id}', 'ProductController::update')->middleware('ProductAuthMiddleware');
$router->get('/products/delete/{id}', 'ProductController::delete')->middleware('ProductAuthMiddleware');