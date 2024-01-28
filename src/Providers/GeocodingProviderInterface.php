<?php

declare(strict_types=1);

namespace MapsTask\Providers;

interface GeocodingProviderInterface
{
    public function getData(string $address): array;
}
