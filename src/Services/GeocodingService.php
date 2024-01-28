<?php

declare(strict_types=1);

namespace MapsTask\Services;

use MapsTask\DTO\GoogleMapsProviderData;
use MapsTask\DTO\OSMGeocodingProviderData;
use MapsTask\Formatters\GoogleMapsProviderDataFormatter;
use MapsTask\Formatters\OSMGeocodingProviderDataFormatter;
use MapsTask\Providers\GeocodingProviderInterface;

class GeocodingService implements GeocodingServiceInterface
{
    private GeocodingProviderInterface $geocodingProvider;

    public function __construct(GeocodingProviderInterface $geocodingProvider)
    {
        $this->geocodingProvider = $geocodingProvider;
    }

    public function getCoordinatesFromAddress(string $address): array
    {
        try {
            $data = $this->geocodingProvider->getData($address);
            if (empty($data)) {
                throw new \Exception("Empty data");
            }
            return $this->getCoordinates($data);
        } catch (\Exception $exception) {
            return ['message' => $exception->getMessage()];
        }
    }

    private function getCoordinates(array $data): array
    {
        $response = [];

        foreach ($data as $item) {
            if ($item instanceof OSMGeocodingProviderData) {
                $response[] = OSMGeocodingProviderDataFormatter::format($item);
            } elseif ($item instanceof GoogleMapsProviderData) {
                $response[] = GoogleMapsProviderDataFormatter::format($item);
            }
        }

        return $response;
    }
}
