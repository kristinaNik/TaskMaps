<?php

declare(strict_types=1);

namespace MapsTask\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;;
use MapsTask\Mappers\MapperInterface;

class OSMGeocodingProvider implements GeocodingProviderInterface
{
	const API_ENDPOINT = 'https://nominatim.openstreetmap.org/search?format=json&q=%s';
	const USER_AGENT = 'Nominatim-Test';

	private Client $client;

	private MapperInterface $mapper;

	public function __construct(Client $client, MapperInterface $mapper)
	{
		$this->client = $client;
		$this->mapper = $mapper;
	}

	public function getData(string $address): array
	{
		$url = sprintf(self::API_ENDPOINT, urlencode($address));

		try {
			$request = new Request('GET', $url, [
				'headers' => [
					'User-Agent' => self::USER_AGENT
				]
			]);

			$response = $this->client->send($request);
			$data = json_decode($response->getBody()->getContents(), true);

			return $this->mapper->mapToDTO($data);

		} catch (\Exception $exception) {
			return  [
				'message' => $exception->getMessage(),
				'code' => $exception->getCode()
			];
		}
	}
}
