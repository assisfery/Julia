<?php

namespace Julia;

include 'Model/Message.php';
include 'Model/Reply.php';
include 'Model/Flow.php';
include 'Model/Dialog.php';
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

	// chache the dialogue
	public $flow;

	function __construct() {
		$this->replies = new Reply();
		$this->flow = new Flow();
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
		// how to compare
		$howToCompare = $compare ?? $this->verificationType;
		
		// find a output/understands something
		$match = false;

		// regex matches / only will be set in regex comparison
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

		// flow cache
		$this->flow->dialogs[] = new Dialog($input, null, $callback, $howToCompare);

		// if found something
		// execute the callback
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

	function answerAs($input)
	{
		$l = count($this->flow->dialogs);

		for($i = 0; $i < $l; $i++)
		{
			if($input == $this->flow->dialogs[$i]->input)
			{

				// copied in hears method
				$howToCompare = $this->flow->dialogs[$i]->compare ?? $this->verificationType;
				$match = false;
				$output_matches = null;

				if($howToCompare == "contains")
					if(Str::contains(Str::lower($input), Str::lower($this->flow->dialogs[$i]->input)))
						$match = true;
				else if($howToCompare == "equality")
					if($input == $this->flow->dialogs[$i]->input)
						$match = true;
				else if($howToCompare == "regex")
					if(preg_match($this->flow->dialogs[$i]->input, $input, $output_matches, PREG_OFFSET_CAPTURE))
					{
						$match = true;
						$l2 = count($output_matches);
						$o = array();
						for($j = 1; $j < $l2; $j++)
						{
							$o[] = $output_matches[$j][0];
						}
						$output_matches = $o;
					}

				if($match)
				{
					$this->understandSomething = true;
					call_user_func($this->flow->dialogs[$i]->callback, $this);
				}
				// end copy
	
			}
		}
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