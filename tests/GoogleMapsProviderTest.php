<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use MapsTask\Mappers\MapperInterface;
use MapsTask\Providers\GoogleMapsProvider;
use PHPUnit\Framework\TestCase;

class GoogleMapsProviderTest extends TestCase
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
		$httpClientMock->shouldReceive('get')
			->andReturn(new Response(200, [], $apiResponse));

		$mapperMock = Mockery::mock(MapperInterface::class);
		$mapperMock->shouldReceive('mapToDTO')->andReturn($responseData);

		$googleMapsProvider = new GoogleMapsProvider('fake_api_key', $httpClientMock, $mapperMock);

		$result = $googleMapsProvider->getData($address);

		$this->assertIsArray($result);
		$this->assertEquals($expectedResult, $result);
	}

	/**
	 * @dataProvider getDataWithInvalidResponseProvider
	 */
	public function testGetDataWithInvalidResponse(
		string $address,
		string $apiResponse,
		array $responseData
	) {

		$httpClientMock = Mockery::mock(Client::class);
		$httpClientMock->shouldReceive('get')
			->andReturn(new Response(404, [], $apiResponse));

		$mapperMock = Mockery::mock(MapperInterface::class);
		$mapperMock->shouldReceive('mapToDTO')->andReturn($responseData);

		$googleMapsProvider = new GoogleMapsProvider('fake_api_key', $httpClientMock, $mapperMock);

		$result = $googleMapsProvider->getData($address);

		$this->assertEquals([], $result);
	}

	public function getDataWithInvalidResponseProvider(): array
	{
		return [
			'test with invalid response' => [
				'address' => 'TestAddress',
				'api_response' => '{
                    "status": "INVALID",
                    "results": []
                }',
				'response_data' => [],
			],
		];
	}

	public function getDataWithValidResponseProvider(): array
	{
		return [
			'test with valid response' => [
				'address' => 'TestAddress',
				'api_response' => '{
                    "status": "OK",
                    "results": [
                        {
                            "geometry": {
                                "location": {
                                    "lat": 40.7128,
                                    "lng": -74.0060
                                }
                            }
                        }
                    ]
                }',
				'response_data' => ['lat' => 40.7128, 'lng' => -74.0060],
				'expected_result' => ['lat' => 40.7128, 'lng' => -74.0060],
			],
		];
	}
}