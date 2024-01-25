<?php

declare(strict_types=1);

namespace src\Services;

interface GeocodingInterface
{
  public function getCoordinatesFromAddress(string $address);
}
