<?php

use MapsTask\Controllers\GeocodingController;

require_once 'vendor/autoload.php';
require 'src/bin/build.php';

$container = build();

$geocodingController = $container->get(GeocodingController::class);
$result = $geocodingController->index('Varna');
var_dump($result);

