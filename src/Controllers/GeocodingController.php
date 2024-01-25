<?php

declare(strict_types=1);

namespace MapsTask\Controllers;

use src\Services\GeocodingInterface;

class GeocodingController
{
    public function __construct(private GeocodingInterface $geocodingService) {
    }

    public function getCoordinates(string $address) {

      return $this->geocodingService->getCoordinates($address);
    }
}
