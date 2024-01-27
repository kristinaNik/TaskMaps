<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use MapsTask\DTO\OSMGeocodingProviderData;
use MapsTask\Mappers\MapperInterface;
use MapsTask\Providers\OSMGeocodingProvider;
use PHPUnit\Framework\TestCase;

class OSMGeocodingProviderTest extends TestCase
{
	/**
	 * @dataProvider getDataWithValidResponseProvider
	 */
	public function testGetDataWithValidResponse(
		string $address,
		string $apiResponse,
		array $responseData,
		array $expectedResult
	) {
		$httpClientMock = Mockery::mock(Client::class);
		$httpClientMock->shouldReceive('send')
			->andReturn(new Response(200, [], $apiResponse));

		$mapperMock = Mockery::mock(MapperInterface::class);
		$mapperMock->shouldReceive('mapToDTO')->andReturn($responseData);

		$osmProvider = new OSMGeocodingProvider($httpClientMock, $mapperMock);

		$result = $osmProvider->getData($address);

		$this->assertIsArray($result);
		$this->assertEquals($expectedResult, $result);
	}

	/**
	 * @dataProvider getDataWithInvalidResponseProvider
	 */
	public function testGetDataWithInvalidResponse(
		string $address,
		int $statusCode,
		string $apiResponse
	) {

		$httpClientMock = Mockery::mock(Client::class);
		$httpClientMock->shouldReceive('send')
			->andReturn(new Response($statusCode, [], $apiResponse));

		$mapperMock = Mockery::mock(MapperInterface::class);

		$osmProvider = new OSMGeocodingProvider($httpClientMock, $mapperMock);

		$result = $osmProvider->getData($address);

		$this->assertIsArray($result);
		$this->assertArrayHasKey('message', $result);
		$this->assertArrayHasKey('code', $result);
	}

	public function getDataWithInvalidResponseProvider(): array
	{
		return [
			'test with invalid response' => [
				'address' => 'TestAddress',
				'status_code' => 404,
				'api_response' => '{"error": "Not Found"}',
			],
		];
	}

	public function getDataWithValidResponseProvider(): array
	{
		return [
			'test with valid response' => [
				'address' => 'TestAddress',
				'api_response' => '{
                    "place_id": 123,
                    "osm_type": "type1", 
                    "osm_id": 456, 
                    "lat": "10.123", 
                    "lon": "20.345",
                    "class": "class1", 
                    "type": "type1", 
                    "addresstype": "addresstype1", 
                    "name": "name1",
                    "display_name": "display_name1"
                }',
				'response_data' => [
					new OSMGeocodingProviderData(
						123,
						'type1',
						456,
						'10.123',
						'20.345',
						'class1',
						'type1',
						'addresstype1',
						'name1',
						'display_name1',
					),
				],
				'expected_result' => [
					new OSMGeocodingProviderData(
						123,
						'type1',
						456,
						'10.123',
						'20.345',
						'class1',
						'type1',
						'addresstype1',
						'name1',
						'display_name1',
					),
				],
			],
		];
	}
}