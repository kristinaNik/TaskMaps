<?php
use DI\ContainerBuilder;


$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(true);

return [
  'definitions' => [
    \src\MapsTask\Controllers\GeocodingController::class => \DI\autowire(),
   \src\MapsTask\Providers\GeocodingProviderInterface::class => \DI\get(\src\MapsTask\Providers\OSMGeocodingProvider::class), // Replace with the actual concrete implementation
   \src\MapsTask\Services\GeocodingService::class => \DI\autowire()
      ->constructor(\DI\get(\src\MapsTask\Providers\GeocodingProviderInterface::class)),
    \src\MapsTask\Providers\OSMGeocodingProvider::class => \DI\autowire(),
    \src\MapsTask\Providers\GoogleMapsProvider::class => \DI\autowire(),
  ],
];
