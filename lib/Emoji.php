<?php

namespace Julia;

class Emoji
{
	public static $smile = "😀";
	public static $laugh = "😂";
	public static $in_love = "😍";
	public static $neutral = "😐";
	public static $expressionless = "😑";
	public static $winking = "😉";
	public static $heart_kiss = "😘";
	public static $kiss = "😗";
	public static $confused = "😕";
	public static $angry = "😠";
	public static $crying = "😢";
	public static $disappointed = "😞";
	public static $kiss_mark = "💋";
	public static $heart = "❤";
	public static $thumbs_up = "👍";
	public static $fire = "🔥";
	public static $frowning = "☹";
	public static $hushed = "😯";

	public static function mult($emoji, $times = 3)
	{
		$r = "";

		for($i = 0; $i < $times; $i++)
		{
			$r .= $emoji;
		}

		return $r;
	}

}

?>