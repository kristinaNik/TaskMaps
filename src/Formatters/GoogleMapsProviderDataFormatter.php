<?php

namespace MapsTask\Formatters;

use MapsTask\DTO\GoogleMapsProviderData;

class GoogleMapsProviderDataFormatter
{
	public static function format(array $data): array
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