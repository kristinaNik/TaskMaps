<?php

require_once 'vendor/autoload.php';
require 'geocode.php';

try {
	loadView($_ENV['PROVIDER']);
} catch (Exception $e) {
	echo json_encode(['error' => "Couldn't load view"]);
	exit;
}