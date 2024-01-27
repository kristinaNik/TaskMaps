<?php

use DI\ContainerBuilder;
use GuzzleHttp\Client;
use MapsTask\Controllers\GeocodingController;
use MapsTask\Factories\GeocodingServiceFactory;
use MapsTask\Mappers\GoogleMapsMapper;
use MapsTask\Mappers\OSMGeocodingMapper;
use MapsTask\Providers\GeocodingProviderInterface;
use MapsTask\Providers\GoogleMapsProvider;
use MapsTask\Providers\OSMGeocodingProvider;
use MapsTask\Services\GeocodingService;

/**
 * @throws Exception
 */
function build()
{
	$containerBuilder = new ContainerBuilder();
	$container = $containerBuilder->build();

	// Register GuzzleHTTP Client
	$container->set(Client::class, function () {
		return new GuzzleHttp\Client();
	});

	// Register OSMGeocodingProvider
	$container->set(OSMGeocodingProvider::class, \DI\create()
		->constructor(
			\DI\get(Client::class),
			\DI\get(OSMGeocodingMapper::class)
		)
	);

	// Register GoogleMapsProvider
	$container->set(GoogleMapsProvider::class, \DI\create()
		->constructor(
			\DI\value('test_key'), // API key
			\DI\get(Client::class),
			\DI\get(GoogleMapsMapper::class)
		)
	);

	// Register GeocodingService
	$container->set(GeocodingService::class, function () use ($container) {
		$osmProvider = $container->get(OSMGeocodingProvider::class);
		$googleMapsProvider = $container->get(GoogleMapsProvider::class);

		// Choose to work with which provider
		return GeocodingServiceFactory::create($osmProvider);
	});

	// Register GeocodingController
	$container->set(GeocodingController::class, \DI\create()
		->constructor(\DI\get(GeocodingService::class))
	);

	return $container;
}

