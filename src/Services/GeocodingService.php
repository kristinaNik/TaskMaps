<?php

namespace src\Services;

use MapsTask\Providers\GeocodingProviderInterface;

class GeocodingService implements GeocodingInterface
{
    public function __construct(private GeocodingProviderInterface $geocodingProvider) {

    }

    public function getCoordinatesFromAddress(string $address): array
    {
        return $this->geocodingProvider->getCoordinates($address);
    }
}
