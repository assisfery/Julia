<?php

namespace Julia;

class HttpRequest
{
	public static function body()
	{
		$body = file_get_contents('php://input');
		return json_decode($body);
	}
}

?>