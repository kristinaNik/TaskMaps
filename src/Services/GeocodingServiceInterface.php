<?php

declare(strict_types=1);

namespace MapsTask\Services;

interface GeocodingServiceInterface
{
    public function getCoordinatesFromAddress(string $address);
}
