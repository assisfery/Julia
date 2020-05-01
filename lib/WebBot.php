<?php

namespace Julia;

include 'Model/Message.php';
include 'Model/Reply.php';

class WebBot
{
	public $replys;
	public $heard;

	function __construct() {
		$this->replys = new Reply();
	}

	function listen()
	{
		$this->heard = new Message("text", "hello");
	}

	function hears($input, $callback)
	{
		if($input == $this->heard->content)
		{
			$callback($this);
		}
	}

	function answer($msg)
	{
		$this->replys->add($msg);
	}

	function respond()
	{
		echo json_encode($this->replys);
	}
}

?>