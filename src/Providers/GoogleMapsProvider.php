<?php

declare(strict_types=1);

namespace MapsTask\Providers;

use GuzzleHttp\Client;

class GoogleMapsProvider implements GeocodingProviderInterface
{
	const API_ENDPOINT = "https://maps.googleapis.com/maps/api/geocode/json";
	private string $apiKey;
	private Client $client;

	public function __construct(string $apiKey, Client $client)
	{
		$this->apiKey = $apiKey;
		$this->client = $client;
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
				return [
					'error_message' => $data['error_message']
				];
			}

			$location = $data['results'][0]['geometry']['location'] ?? null;

			if (!$location) {
				// Handle missing or malformed data
				return [];
			}

			return [
				'latitude' => $location['lat'],
				'longitude' => $location['lng'],
			];

		} catch (\Exception $exception) {
			return [
				'message' => $exception->getMessage(),
				'code' => $exception->getCode()
			];
		}
	}
}
