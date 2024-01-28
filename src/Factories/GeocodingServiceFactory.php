<?php

namespace MapsTask\Factories;

use MapsTask\Providers\GeocodingProviderInterface;
use MapsTask\Services\GeocodingService;
use MapsTask\Services\GeocodingServiceInterface;

class GeocodingServiceFactory
{
    public static function create(GeocodingProviderInterface $geocodingProvider): GeocodingServiceInterface
    {
        return new GeocodingService($geocodingProvider);
    }
}
