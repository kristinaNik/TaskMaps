<?php

declare(strict_types=1);

namespace MapsTask\Controllers;

use MapsTask\Services\GeocodingInterface;

class GeocodingController
{
	private GeocodingInterface $geocodingService;

	public function __construct(GeocodingInterface $geocodingService)
	{
		$this->geocodingService = $geocodingService;
	}

	public function index(string $address): false|string
	{
		$coordinatesData = $this->geocodingService->getCoordinatesFromAddress($address);

		return json_encode($coordinatesData);
	}
}
