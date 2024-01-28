<?php

use DI\ContainerBuilder;
use GuzzleHttp\Client;
use MapsTask\Controllers\GeocodingController;
use MapsTask\Factories\GeocodingServiceFactory;
use MapsTask\Mappers\GoogleMapsMapper;
use MapsTask\Mappers\OSMGeocodingMapper;
use MapsTask\Providers\GoogleMapsProvider;
use MapsTask\Providers\OSMGeocodingProvider;
use MapsTask\Services\GeocodingService;

/**
 * @throws Exception
 */
function build(string $provider)
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
			\DI\value($_ENV['GOOGLE_API_KEY']),
			\DI\get(Client::class),
			\DI\get(GoogleMapsMapper::class)
		)
	);

	// Register GeocodingService
	$container->set(GeocodingService::class, function () use ($container, $provider) {
		$osmProvider = $container->get(OSMGeocodingProvider::class);
		$googleMapsProvider = $container->get(GoogleMapsProvider::class);

		try {
			$chosenProvider = match ($provider) {
				'osm' => $osmProvider,
				'google_maps' => $googleMapsProvider
			};
		} catch (\UnhandledMatchError $e) {
			echo json_encode(['error' => "No available provider"]);
			exit;
		}

		return GeocodingServiceFactory::create($chosenProvider);
	});

	// Register GeocodingController
	$container->set(GeocodingController::class, \DI\create()
		->constructor(\DI\get(GeocodingService::class))
	);

	return $container;
}


function loadView(string $provider): void
{
	try {
		match ($provider) {
			'osm' => require 'view/osm_map.html',
			'google_maps' => require 'view/google_maps.html',
		};
	} catch (\UnhandledMatchError $e) {
		echo json_encode(['error' => "No available provider"]);
		exit;
	}
}

