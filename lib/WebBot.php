<?php

namespace Julia;

include 'Model/Message.php';
include 'Model/Reply.php';
include 'Util/HttpRequest.php';

class WebBot
{
	public $replys;
	public $heard;

	function __construct() {
		$this->replys = new Reply();
	}

	// receive all inputs
	function listen()
	{
		// read the http body
		$receivedMessage = HttpRequest::body();

		// get the message received
		$type = $receivedMessage->type ?? "text";
		$content = $receivedMessage->content ?? "";

		// set what was read
		$this->heard = new Message($type, $content);
	}

	// verify if input is like expected
	function hears($input, $callback)
	{
		if($input == $this->heard->content)
		{
			$callback($this);
		}
	}

	// add the answer to the replys
	function answer($msg)
	{
		$this->replys->add($msg);
	}

	// echo all outputs
	function respond()
	{
		header('Content-Type: application/json');
		echo json_encode($this->replys);
	}
}

?>