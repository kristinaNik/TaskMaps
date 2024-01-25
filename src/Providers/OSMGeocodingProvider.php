<?php

namespace MapsTask\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class OSMGeocodingProvider implements GeocodingProviderInterface
{
    const API_ENDPOINT = 'https://nominatim.openstreetmap.org/search?format=json&q=%s';

    private Client $client;
    public function __construct(Client $client)
    {
      $this->client = $client;
    }

  public function getCoordinates(string $address): array
  {
    $url = sprintf(self::API_ENDPOINT, urlencode($address));
    $request = new Request('GET', $url, [
      'headers' => [
        'User-Agent: Nominatim-Test'
      ]
    ]);

    // Execute request
    $response = $this->client->send($request);

    // Decode the JSON response
    $data = json_decode($response->getBody(), true);

    // Extract and return coordinates (assuming the first result)
    return [
      'latitude' => $data[0]['lat'] ?? null,
      'longitude' => $data[0]['lon'] ?? null,
    ];
  }
}
