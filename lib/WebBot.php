<?php

namespace Julia;

include 'Model/Message.php';
include 'Model/Reply.php';
include 'Util/HttpRequest.php';
include 'Util/String.php';
include 'Emoji.php';

class WebBot
{
	// the message replies that will
	// be sent to the user
	public $replies;

	// the message that we received from
	// the user
	public $heard;

	// when the chatbot understands something
	// this will be set to true
	// so the chatbot will not be confuse
	// and give the confuse/callback reponse
	public $understandSomething = false;

	// the comparation operator
	// we gonna use to compare
	// the message from the user and what we expected
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

		// if the comparation operator
		// is equality we gonna compare with == operator
		if($howToCompare == "contains")
		{
			if(Str::contains(Str::lower($this->heard->content), Str::lower($input)))
			{
				$match = true;
			}
		}
		else if($howToCompare == "equality")
		{
			if($input == $this->heard->content)
			{
				// at end we will know
				// that something match
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

				// extract the matches variable in regex
				// to more plain variable
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

			// call the callback function
			// because the input from user matches with
			// something we were expecting
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