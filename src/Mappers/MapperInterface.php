<?php

namespace MapsTask\Mappers;

interface MapperInterface
{
	public function mapToDTO(array $data): array;
}