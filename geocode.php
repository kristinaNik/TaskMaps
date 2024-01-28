<?php

require_once 'vendor/autoload.php';
require 'bin/build.php';

use MapsTask\Controllers\GeocodingController;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
	$container = build($_ENV['PROVIDER']);
} catch (Exception $e) {
	echo json_encode(['error' => 'Error building the container']);
	exit;
}

$geocodingController = $container->get(GeocodingController::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$address = $_POST['address'] ?? '';

	$coordinatesData = $geocodingController->index($address);

	echo $coordinatesData;
}