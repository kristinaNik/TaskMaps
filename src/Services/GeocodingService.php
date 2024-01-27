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

			$response = [];

			foreach ($data as $item) {
				if ($item instanceof OSMGeocodingProviderData) {
					$response[] = [
						'name' => $item->getName(),
						'lon' => $item->getLon(),
						'lat' => $item->getLat()
					];
				} elseif ($item instanceof GoogleMapsProviderData) {
					$response[] = [
						'lat' => $item->getLatitude(),
						'lng' => $item->getLongitude()
					];
				}
			}

			return $response;
		} catch (\Exception $exception) {
			return [
				'message' => $exception->getMessage()
			];
		}
	}
}
