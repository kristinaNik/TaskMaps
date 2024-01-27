<?php

use DI\ContainerBuilder;
use GuzzleHttp\Client;
use MapsTask\Controllers\GeocodingController;
use MapsTask\Providers\GeocodingProviderInterface;
use MapsTask\Providers\GoogleMapsProvider;
use MapsTask\Providers\OSMGeocodingProvider;
use MapsTask\Services\GeocodingService;
use Resources\Resource;

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
        \DI\get(Client::class)
      )
  );
//  $container->set(GeocodingProviderInterface::class,
//    \DI\create(GoogleMapsProvider::class)
//      ->constructor(
//        \DI\value('test_key'), //API key
//        \DI\create(Client::class)
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

