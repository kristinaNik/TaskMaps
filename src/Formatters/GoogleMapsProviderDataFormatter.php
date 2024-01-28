<?php

declare(strict_types=1);

namespace MapsTask\Formatters;

use MapsTask\DTO\GoogleMapsProviderData;

class GoogleMapsProviderDataFormatter
{
    public static function format(GoogleMapsProviderData $item): array
    {
        return [
            'lat' => $item->getLatitude(),
            'lng' => $item->getLongitude(),
        ];
    }
}
