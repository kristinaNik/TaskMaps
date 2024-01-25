<?php

namespace MapsTask\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

class OSMGeocodingProvider implements GeocodingProviderInterface
{
    const API_ENDPOINT = 'https://nominatim.openstreetmap.org/search?format=json&q=%s';

    public function __construct(private Client $client)
    {
    }

  public function getCoordinates(string $address): array
  {
      return [];
  }
}
