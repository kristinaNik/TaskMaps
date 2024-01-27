<?php

use DI\ContainerBuilder;
use GuzzleHttp\Client;
use MapsTask\Controllers\GeocodingController;
use MapsTask\Mappers\OSMGeocodingMapper;
use MapsTask\Providers\GeocodingProviderInterface;
use MapsTask\Providers\OSMGeocodingProvider;
use MapsTask\Services\GeocodingService;

/**
 * @throws Exception
 */
function build()
{
	$containerBuilder = new ContainerBuilder();
	$container = $containerBuilder->build();


	// Register dependencies
	$container->set(Client::class, function () {
		return new GuzzleHttp\Client();
	});

	$container->set(GeocodingProviderInterface::class,
		\DI\create(OSMGeocodingProvider::class)
			->constructor(
				\DI\get(Client::class),
				\DI\get(OSMGeocodingMapper::class)
			)
	);
	//  $container->set(GeocodingProviderInterface::class,
	//    \DI\create(GoogleMapsProvider::class)
	//      ->constructor(
	//        \DI\value('test_key'), //API key
	//        \DI\get(Client::class),
	//		\DI\get(GoogleMapsMapper::class)
	//      )
	//  );
	$container->set(GeocodingService::class,
		\DI\create()->constructor(\DI\get(GeocodingProviderInterface::class))
	);
	$container->set(GeocodingController::class,
		\DI\create()->constructor(\DI\get(GeocodingService::class))
	);

	return $container;
}

