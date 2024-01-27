<?php

namespace MapsTask\Services;

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

			$response = [];

			/** @var OSMGeocodingProviderData $item */
			foreach ($data as $item) {
				$response[] = [
					'name' => $item->getName(),
					'lon' => $item->getLon(),
					'lat' => $item->getLat()
				];
			}

			return $response;
		} catch (\Exception $exception) {
			return [
				'message' => $exception->getMessage()
			];
		}
	}
}
