<?php

declare(strict_types=1);

namespace MapsTask\Formatters;

use MapsTask\DTO\OSMGeocodingProviderData;

class OSMGeocodingProviderDataFormatter
{
	public static function format(OSMGeocodingProviderData $item): array
	{
		return [
			'name' => $item->getName(),
			'lon'  => $item->getLon(),
			'lat'  => $item->getLat(),
		];
	}
}
