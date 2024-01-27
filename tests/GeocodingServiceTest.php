<?php

use MapsTask\DTO\GoogleMapsProviderData;
use MapsTask\DTO\OSMGeocodingProviderData;
use MapsTask\Providers\GeocodingProviderInterface;
use MapsTask\Services\GeocodingService;
use PHPUnit\Framework\TestCase;

class GeocodingServiceTest extends TestCase
{

	/**
	 * @dataProvider geocodingServiceProvider
	 */
	public function testGetCoordinatesFromAddress(
		?OSMGeocodingProviderData $osmProviderData,
		?GoogleMapsProviderData $googleMapsProviderData,
		array $expectedResult
	)
	{
		// Mock the GeocodingProviderInterface for OSM data
		$osmProviderMock = $this->createMock(GeocodingProviderInterface::class);
		$osmProviderMock->method('getData')->willReturn([$osmProviderData, $googleMapsProviderData]);

		// Create GeocodingService instance with the mock
		$geocodingService = new GeocodingService($osmProviderMock);

		// Call the method under test
		$result = $geocodingService->getCoordinatesFromAddress('Varna');

		$this->assertEquals($expectedResult, $result);
	}

	public function geocodingServiceProvider(): array
	{
		return [
			'test get coordinates from address with OSM' => [
				'osm_provider_data' => new OSMGeocodingProviderData(
					123,
					'test',
					345,
					'10.123',
					'20.345',
					'class',
					'type',
					'address',
					'Varna',
					'Varna, Bulgaria',
				),
				'google_maps_provider_data' => null,
				'expected_result' => [
					[
						'name' => 'Varna',
						'lon' => '20.345',
						'lat' => '10.123',
					],
				],
			],
			'test get coordinates from address with Google Maps' => [
				'osm_provider_data' => null,
				'google_maps_provider_data' => new GoogleMapsProviderData(
					'40.7128',
					'-74.0060'
				),
				'expected_result' => [
					[
						'lat' => '40.7128',
						'lng' => '-74.0060',
					],
				],
			],
		];
	}
}