<?php

use MapsTask\Controllers\GeocodingController;

require_once 'vendor/autoload.php';
require 'bin/build.php';

try {
	$container = build();
} catch (Exception $e) {
	echo 'error building the container';
}

$geocodingController = $container->get(GeocodingController::class);

/**
 * @todo remove hardcoded example
 */
$result = $geocodingController->index('Varna');
echo $result;

