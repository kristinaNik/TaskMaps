<?php

declare(strict_types=1);

namespace MapsTask\DTO;

class GoogleMapsProviderData
{
    public function __construct(private string $latitude, private string $longitude)
    {
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }
}
