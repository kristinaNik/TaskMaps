<?php

declare(strict_types=1);

namespace MapsTask\DTO;

class OSMGeocodingProviderData
{
    public function __construct(
        private int $placeId,
        private string $osmType,
        private int $osmId,
        private string $lat,
        private string $lon,
        private string $class,
        private string $type,
        private string $addressType,
        private string $name,
        private string $displayName
    ) {
    }

    public function getPlaceId(): int
    {
        return $this->placeId;
    }

    public function getOsmType(): string
    {
        return $this->osmType;
    }

    public function getOsmId(): int
    {
        return $this->osmId;
    }

    public function getLat(): string
    {
        return $this->lat;
    }

    public function getLon(): string
    {
        return $this->lon;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAddressType(): string
    {
        return $this->addressType;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }
}
