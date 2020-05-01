<?php

namespace Julia;

class Message
{
	public $type;
	public $content;

	public $user_id;

	function __construct($type, $content, $user_id = null) {
		$this->type = $type;
		$this->content = $content;
		$this->user_id = $user_id;
	}
}

?>