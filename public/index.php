<?php
declare(strict_types = 1);
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../App/Routes.php";
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();