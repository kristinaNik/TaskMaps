<?php

namespace MapsTask\Services;

use MapsTask\Providers\GeocodingProviderInterface;

class GeocodingService implements GeocodingInterface
{
  private GeocodingProviderInterface $geocodingProvider;
    public function __construct(GeocodingProviderInterface $geocodingProvider) {

        $this->geocodingProvider = $geocodingProvider;
    }

    public function getCoordinatesFromAddress(string $address): array
    {
        return $this->geocodingProvider->getCoordinates($address);
    }
}
