<?php

namespace MapsTask\Mappers;

use MapsTask\DTO\GoogleMapsProviderData;

class GoogleMapsMapper
{
	public static function mapToDTO(array $data): array
	{
		$response = [];

		foreach ($data as $item) {
			$response[] = new GoogleMapsProviderData(
				$item['lat'],
				$item['lng']
			);
		}

		return $response;
	}
}