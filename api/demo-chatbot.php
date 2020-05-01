<?php

include "../lib/WebBot.php";

use Julia\WebBot;
use Julia\Message;
use Julia\Emoji;

// prepare
$myBot = new WebBot();
$myBot->listen();

// conversation logic
$myBot->hears("hello", function($bot){

	$bot->answer(new Message("text", "Hello my friend " . Emoji::mult(Emoji::$smile) ));

});

$myBot->hears("bye", function($bot){

	$bot->answerRandom([
			new Message("text", "See you later"),
			new Message("text", "Bye my dear friend")
		]);

}, "equality");

$myBot->hears("/how is going*|how are you*/", function($bot){

	$bot->answer(new Message("text", "I am cool"));

}, "regex");

$myBot->hears("image", function($bot){

	$bot->answer(new Message("image", "https://images.unsplash.com/photo-1548717584-eac43a401252?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"));

	$bot->answer(new Message("text", "@alexpaganelli at Mindelo, S. Vicente, Cabo Verde"));

});

$myBot->confuse(function($bot){

	$bot->answer(new Message("text", "I didnt understand " . Emoji::mult(Emoji::$confused) ));

});

// respond
$myBot->respond();

?>