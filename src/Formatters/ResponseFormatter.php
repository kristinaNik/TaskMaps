<?php

declare(strict_types=1);

namespace MapsTask\Formatters;

class ResponseFormatter
{
	public static function jsonResponse(array $data, int $statusCode = 200): string
	{
		http_response_code($statusCode);

		return json_encode($data, JSON_UNESCAPED_UNICODE);
	}
}