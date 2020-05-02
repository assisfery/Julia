<?php

namespace Julia;

include 'Model/Message.php';
include 'Model/Reply.php';
include 'Util/HttpRequest.php';
include 'Util/String.php';
include 'Emoji.php';

class WebBot
{
	public $replies;
	public $heard;

	public $understandSomething = false;

	public $verificationType = "contains";

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

		$output_matches = null;

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
		else if($howToCompare == "contains")
		{
			if(Str::contains(Str::lower($this->heard->content), Str::lower($input)))
			{
				$match = true;
			}
		}
		else if($howToCompare == "regex")
		{
			if(preg_match($input, $this->heard->content, $output_matches, PREG_OFFSET_CAPTURE))
			{
				$match = true;

				$l = count($output_matches);
				$o = array();

				for($i = 1; $i < $l; $i++)
				{
					$o[] = $output_matches[$i][0];
				}

				$output_matches = $o;
			}
		}

		if($match)
		{
			// DONT BE CONFUSE AT END
			$this->understandSomething = true;

			$callback($this, $output_matches);
		}		
	}

	// add the answer to the replies
	function answer($msg)
	{
		$this->replies->add($msg);
	}

	function answerRandom($msgs)
	{
		$l = count($msgs);

		$i = mt_rand(0, $l-1);

		$this->replies->add($msgs[$i]);
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