<?php

declare(strict_types=1);

namespace MapsTask\DTO;

class GoogleMapsProviderData
{
	private string $latitude;
	private string $longitude;

	/**
	 * @param string $latitude
	 * @param string $longitude
	 */
	public function __construct(string $latitude, string $longitude)
	{
		$this->latitude = $latitude;
		$this->longitude = $longitude;
	}

	public function getLatitude(): string
	{
		return $this->latitude;
	}

	public function getLongitude(): string
	{
		return $this->longitude;
	}
}
