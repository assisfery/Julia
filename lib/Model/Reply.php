<?php

namespace Julia;

class Reply
{
	public $messages = array();

	function add($msg)
	{
		$this->messages[] = $msg;
	}
}

?>