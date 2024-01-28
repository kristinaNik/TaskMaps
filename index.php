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
$result = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$address = $_POST['address'] ?? '';

	$result = $geocodingController->index($address);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geocoding Form</title>
</head>
<body>

<h1>Geocoding Form</h1>

<form method="post" action="">
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>
    <button type="submit">Submit</button>
</form>

<div id="result">
	<?php echo $result; ?>
</div>

</body>
</html>


