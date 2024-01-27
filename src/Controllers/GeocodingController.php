<?php

declare(strict_types=1);

namespace MapsTask\Controllers;

use MapsTask\Services\GeocodingInterface;

class GeocodingController
{
	public function __construct(private GeocodingInterface $geocodingService) {}

	public function index(string $address): false|string
	{
		$coordinatesData = $this->geocodingService->getCoordinatesFromAddress($address);

		return json_encode($coordinatesData);
	}
}
