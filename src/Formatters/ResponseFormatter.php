<?php

declare(strict_types=1);

namespace MapsTask\Formatters;

class ResponseFormatter
{
	public static function jsonResponse(array $data, int $statusCode): string
	{
		return json_encode($data, JSON_UNESCAPED_UNICODE  | $statusCode);
	}
}