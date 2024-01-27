<?php

declare(strict_types=1);

namespace MapsTask\Services;

use MapsTask\DTO\GoogleMapsProviderData;
use MapsTask\DTO\OSMGeocodingProviderData;
use MapsTask\Providers\GeocodingProviderInterface;

class GeocodingService implements GeocodingInterface
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
				$response[] = $this->getOSMDataCoordinates($item);
			} elseif ($item instanceof GoogleMapsProviderData) {
				$response[] = $this->getGoogleMapsDataCoordinates($item);
			}
		}

		return $response;
	}

	private function getOSMDataCoordinates(OSMGeocodingProviderData $item): array
	{
		return [
			'name' => $item->getName(),
			'lon'  => $item->getLon(),
			'lat'  => $item->getLat(),
		];
	}

	private function getGoogleMapsDataCoordinates(GoogleMapsProviderData $item): array
	{
		return [
			'lat' => $item->getLatitude(),
			'lng' => $item->getLongitude(),
		];
	}
}
