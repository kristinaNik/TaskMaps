<?php

namespace MapsTask\Mappers;

use MapsTask\DTO\OSMGeocodingProviderData;

class OSMGeocodingMapper implements MapperInterface
{
	public static function mapToDTO(array $data): array
	{
		$response = [];

		foreach ($data as $item) {
			$response[] = new OSMGeocodingProviderData(
				$item['place_id'],
				$item['osm_type'],
				$item['osm_id'],
				$item['lat'],
				$item['lon'],
				$item['class'],
				$item['type'],
				$item['addresstype'],
				$item['name'],
				$item['display_name']
			);
		}
		return $response;
	}
}