<?php

use MapsTask\Controllers\GeocodingController;

require_once 'vendor/autoload.php';
require 'src/bin/build.php';

$container = build();

$geocodingController = $container->get(GeocodingController::class);

/**
 * @todo remove hardcoded example
 */
$result = $geocodingController->index('Varna'); //example
dd($result);

