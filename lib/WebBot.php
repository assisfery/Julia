<?php

namespace Julia;

include 'Model/Message.php';
include 'Model/Reply.php';
include 'Util/HttpRequest.php';

class WebBot
{
	public $replys;
	public $heard;

	public $understandSomething = false;

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
			// DONT BE CONFUSE AT END
			$this->understandSomething = true;

			$callback($this);
		}
	}

	// add the answer to the replys
	function answer($msg)
	{
		$this->replys->add($msg);
	}

	// when the bot dont understand nothing
	function confuse($callback)
	{
		if(!$this->understandSomething)
		{
			$callback($this);
		}
	}

	// echo all outputs
	function respond()
	{
		header('Content-Type: application/json');
		echo json_encode($this->replys);
	}
}

?>