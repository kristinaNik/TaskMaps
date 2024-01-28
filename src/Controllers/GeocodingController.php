<?php

declare(strict_types=1);

namespace MapsTask\Controllers;

use MapsTask\Formatters\ResponseFormatter;
use MapsTask\Services\GeocodingInterface;

class GeocodingController
{
    public function __construct(private GeocodingInterface $geocodingService)
    {
    }

    public function index(string $address): string
    {
        try {
            $coordinatesData = $this->geocodingService->getCoordinatesFromAddress($address);

            return ResponseFormatter::jsonResponse(['result' => $coordinatesData], 200);
        } catch (\Exception $exception) {
            return ResponseFormatter::jsonResponse(
                ['error' => 'An error occurred while processing your request.'],
                442
            );
        }
    }
}
