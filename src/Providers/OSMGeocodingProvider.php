<?php

declare(strict_types=1);

namespace MapsTask\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;;
use MapsTask\Formatters\OSMGeocodingProviderDataFormatter;
use MapsTask\Mappers\OSMGeocodingMapper;

class OSMGeocodingProvider implements GeocodingProviderInterface
{
	const API_ENDPOINT = 'https://nominatim.openstreetmap.org/search?format=json&q=%s';

	private Client $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function getData(string $address): array
	{
		$url = sprintf(self::API_ENDPOINT, urlencode($address));

		try {
			$request = new Request('GET', $url, [
				'headers' => [
					'User-Agent: Nominatim-Test'
				]
			]);

			$response = $this->client->send($request);
			$data = json_decode($response->getBody()->getContents(), true);
			return OSMGeocodingMapper::mapToDTO($data);
		} catch (\Exception $exception) {
			return  [
				'message' => $exception->getMessage(),
				'code' => $exception->getCode()
			];
		}
	}
}
