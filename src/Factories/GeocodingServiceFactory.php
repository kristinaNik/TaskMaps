<?php

namespace MapsTask\Factories;

use MapsTask\Providers\GeocodingProviderInterface;
use MapsTask\Services\GeocodingService;

class GeocodingServiceFactory
{
	/**
	 * @param GeocodingProviderInterface $geocodingProvider
	 *
	 * @return GeocodingService
	 */
	public static function create(GeocodingProviderInterface $geocodingProvider): GeocodingService
	{
		return new GeocodingService($geocodingProvider);
	}
}