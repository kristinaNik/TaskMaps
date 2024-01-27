<?php

namespace MapsTask\Mappers;

interface MapperInterface
{
	public static function mapToDTO(array $data): array;
}