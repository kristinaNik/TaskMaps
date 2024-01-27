<?php

use MapsTask\DTO\OSMGeocodingProviderData;
use MapsTask\Providers\GeocodingProviderInterface;
use MapsTask\Services\GeocodingService;
use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{

	public function testGetCoordinatesFromAddressWithOSMData()
	{
		// Mock the GeocodingProviderInterface for OSM data
		$osmProviderMock = $this->createMock(GeocodingProviderInterface::class);
		$osmProviderMock->method('getData')->willReturn([
			new OSMGeocodingProviderData(
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
			)
		]);

		// Create GeocodingService instance with the mock
		$geocodingService = new GeocodingService($osmProviderMock);

		// Call the method under test
		$result = $geocodingService->getCoordinatesFromAddress('Varna');

		// Assertions
		$expectedResult = [
			['name' => 'Varna', 'lon' => '20.345', 'lat' => '10.123']
		];

		$this->assertEquals($expectedResult, $result);
	}

}