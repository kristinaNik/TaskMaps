<?php

declare(strict_types=1);

use MapsTask\Controllers\GeocodingController;
use MapsTask\Services\GeocodingInterface;
use PHPUnit\Framework\TestCase;

class GeocodingControllerTest extends TestCase
{
	/**
	 * @dataProvider indexDataProvider
	 */
	public function testIndex(
		string $address,
		array $coordinateData,
		bool $expectException,
		string $expectedResponse
	): void
	{
		$geocodingService = $this->createMock(GeocodingInterface::class);

		if ($expectException) {
			$geocodingService->expects($this->once())
				->method('getCoordinatesFromAddress')
				->with($address)
				->willThrowException(new \Exception('Sample Exception'));
		} else {
			$geocodingService->expects($this->once())
				->method('getCoordinatesFromAddress')
				->with($address)
				->willReturn($coordinateData);
		}

		$geocodingController = new GeocodingController($geocodingService);
		$response = $geocodingController->index($address);

		$this->assertJsonStringEqualsJsonString($expectedResponse, $response);
	}

	public function indexDataProvider(): array
	{
		return [
			'test return valid response'  => [
				'address' => 'Sample Address',
				'coordinate_data' =>  ['name' => 'Sample Address', 'lat' => 123.456, 'lon' => -45.678],
				'expectException' => false,
				'expectedResponse' => '{"result":{"name":"Sample Address","lat":123.456,"lon":-45.678}}',
			],
			'test handle exception' => [
				'address' => 'Invalid Address',
				'coordinate_data' =>  [],
				'expectException' => true,
				'expectedResponse' => '{"error":"An error occurred while processing your request."}',
			],
		];
	}
}