<?php

declare(strict_types=1);

namespace MapsTask\Providers;

use GuzzleHttp\Client;
use MapsTask\Mappers\MapperInterface;

class GoogleMapsProvider implements GeocodingProviderInterface
{
	const API_ENDPOINT = "https://maps.googleapis.com/maps/api/geocode/json";
	private string $apiKey;
	private Client $client;

	private MapperInterface $mapper;

	public function __construct(string $apiKey, Client $client, MapperInterface $mapper)
	{
		$this->apiKey = $apiKey;
		$this->client = $client;
		$this->mapper = $mapper;
	}

	public function getData(string $address): array
	{

		$params = [
			'address' => $address,
			'key' => $this->apiKey,
		];

		try {
			$response = $this->client->get(self::API_ENDPOINT, ['query' => $params]);

			$data = json_decode($response->getBody()->getContents(), true);


			if ($data['status'] !== 'OK') {
				// Handle Google Maps API error
				return [];
			}
			$locationData = $data['results'][0]['geometry']['location'];

			return $this->mapper->mapToDTO($locationData);

		} catch (\Exception $exception) {
			return [
				'message' => $exception->getMessage(),
				'code' => $exception->getCode()
			];
		}
	}
}
