<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';
$router = new \Bramus\Router\Router();

require_once __DIR__ . '/routes/web.php';

$router->run();
?>