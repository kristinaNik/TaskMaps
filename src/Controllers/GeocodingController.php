<?php

declare(strict_types=1);

namespace MapsTask\Controllers;

use MapsTask\Formatters\ResponseFormatter;
use MapsTask\Services\GeocodingInterface;

class GeocodingController
{
	public function __construct(private GeocodingInterface $geocodingService) {}

	public function index(string $address): string
	{
		try {
			$coordinatesData = $this->geocodingService->getCoordinatesFromAddress($address);

			if (!empty($coordinatesData)) {
				return ResponseFormatter::jsonResponse(['coordinates' => $coordinatesData]);
			} else {
				return ResponseFormatter::jsonResponse(
					['error' => 'No coordinates found for the given address.'],
					JSON_THROW_ON_ERROR
				);
			}
		} catch (\Exception $exception) {
			return ResponseFormatter::jsonResponse(
				['error' => 'An error occurred while processing your request.'],
				JSON_THROW_ON_ERROR
			);
		}
	}
}
