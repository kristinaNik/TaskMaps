<?php

use MapsTask\Controllers\GeocodingController;
use MapsTask\Formatters\ResponseFormatter;

require_once 'vendor/autoload.php';
require 'bin/build.php';

try {
	$container = build();
} catch (Exception $e) {
	echo json_encode(['error' => 'Error building the container']);
	exit;
}

$geocodingController = $container->get(GeocodingController::class);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$address = $_POST['address'] ?? '';

	$coordinatesData = $geocodingController->index($address);

	echo $coordinatesData;

}