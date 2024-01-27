<?php

use MapsTask\Controllers\GeocodingController;

require_once 'vendor/autoload.php';
require 'bin/build.php';

$container = build();

$geocodingController = $container->get(GeocodingController::class);

/**
 * @todo remove hardcoded example
 */
$result = $geocodingController->index('Varna', 'osm'); //example
dd($result);

