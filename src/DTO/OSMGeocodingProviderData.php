<?php

declare(strict_types=1);

namespace MapsTask\DTO;

class OSMGeocodingProviderData
{
	private int $placeId;

	private string $osmType;

	private int $osmId;

	private string $lat;

	private string $lon;

	private string $class;

	private string $type;

	private string $importance;

	private string $addressType;

	private string $name;

	private string $displayName;

	/**
	 * @param int $placeId
	 * @param string $osmType
	 * @param int $osmId
	 * @param string $lat
	 * @param string $lon
	 * @param string $class
	 * @param string $type
	 * @param string $importance
	 * @param string $addressType
	 * @param string $name
	 * @param string $displayName
	 */
	public function __construct(
		int $placeId,
		string $osmType,
		int $osmId,
		string $lat,
		string $lon,
		string $class,
		string $type,
		string $importance,
		string $addressType,
		string $name,
		string $displayName
	) {
		$this->placeId = $placeId;
		$this->osmType = $osmType;
		$this->osmId = $osmId;
		$this->lat = $lat;
		$this->lon = $lon;
		$this->class = $class;
		$this->type = $type;
		$this->importance = $importance;
		$this->addressType = $addressType;
		$this->name = $name;
		$this->displayName = $displayName;
	}

	public function getPlaceId(): int
	{
		return $this->placeId;
	}

	public function getOsmType(): string
	{
		return $this->osmType;
	}

	public function getOsmId(): int
	{
		return $this->osmId;
	}

	public function getLat(): string
	{
		return $this->lat;
	}

	public function getLon(): string
	{
		return $this->lon;
	}

	public function getClass(): string
	{
		return $this->class;
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function getImportance(): string
	{
		return $this->importance;
	}

	public function getAddressType(): string
	{
		return $this->addressType;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getDisplayName(): string
	{
		return $this->displayName;
	}
}
