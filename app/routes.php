<?php

/** @var mixed $router */
$router->get('/', 'controllers/home.php');
$router->get('/listings', 'controllers/listings/index.php');
$router->get('/listings/create', 'controllers/listings/create.php');
$router->get('/auth/register', 'controllers/auth/register.php');
$router->get('/auth/login', 'controllers/auth/login.php');
$router->get('/auth/logout', 'controllers/auth/logout.php');
$router->post('/auth/register', 'controllers/auth/register.php');
$router->post('/auth/login', 'controllers/auth/login.php');
$router->post('/listings/create', 'controllers/listings/create.php');
$router->get('/listings/{id}', 'controllers/listings/show.php');

?>