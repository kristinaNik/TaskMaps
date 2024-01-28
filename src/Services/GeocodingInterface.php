<?php

declare(strict_types=1);

namespace MapsTask\Services;

interface GeocodingInterface
{
    public function getCoordinatesFromAddress(string $address);
}
