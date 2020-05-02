<?php

namespace Julia;

class Dialog
{
	public $compare;
	public $input;

	public $message;

	public $callback;

	function __construct($input, $message = array(), $callback = null, $compare = "contains") {
		$this->input = $input;
		$this->message = $message;
		$this->callback = $callback;
		$this->compare = $compare;
	}

}

?>