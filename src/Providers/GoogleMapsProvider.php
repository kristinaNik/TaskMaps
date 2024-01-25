<?php

declare(strict_types=1);

namespace MapsTask\Providers;

class GoogleMapsProvider implements GeocodingProviderInterface
{

    public function getCoordinates(string $address): array
    {
      return [];
    }
}
