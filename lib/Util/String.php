<?php

namespace Julia;

class Str
{
	public static function contains($input, $search)
	{
		return strpos($input, $search) !== false;
	}

	public static function lower($input)
	{
		return strtolower($input);
	}
}

?>