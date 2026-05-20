<?php

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require "../helpers.php";
require basePath('Router.php');
require basePath('Database.php');

$router = new Router();
$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if (!isset($_SESSION['user_id'])
    && !in_array($uri, ['/auth/login', '/auth/register'])) {
    header("Location: /auth/login");
    exit();
}

$router->route($uri, $method);

?>