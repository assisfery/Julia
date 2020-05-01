<?php

namespace Julia;

include 'Model/Message.php';
include 'Model/Reply.php';
include 'Util/HttpRequest.php';

class WebBot
{
	public $replies;
	public $heard;

	public $understandSomething = false;

	public $verificationType = "case-insensitive";

	function __construct() {
		$this->replies = new Reply();
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
	function hears($input, $callback, $compare = null)
	{
		$howToCompare = $compare ?? $this->verificationType;
		$match = false;

		if($howToCompare == "equality")
		{
			if($input == $this->heard->content)
			{
				$match = true;
			}
		}
		else if($howToCompare == "case-insensitive")
		{
			if(strtolower($input) == strtolower($this->heard->content))
			{
				$match = true;
			}
		}

		if($match)
		{
			// DONT BE CONFUSE AT END
			$this->understandSomething = true;

			$callback($this);
		}		
	}

	// add the answer to the replies
	function answer($msg)
	{
		$this->replies->add($msg);
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
		echo json_encode($this->replies);
	}
}

?>