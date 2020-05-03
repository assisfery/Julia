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

$myBot->hears("/(h|H)(i|ey)/", function($bot){
	$bot->answerAs("hello");
}, "regex");

$myBot->hears("bye", function($bot){

	$bot->answerRandom([
			new Message("text", "See you later"),
			new Message("text", "Bye my dear friend")
		]);

});

$myBot->hears("/how is going*|how are you*/", function($bot){

	$bot->answer(new Message("text", "I am cool"));

}, "regex");

$myBot->hears("/My name is (.*) and i am (.*) years old/", function($bot, $matches){

	$bot->answer(new Message("text", "Nice to meet you " . $matches[0] . " so you have " . $matches[1] ));

}, "regex");

$myBot->hears("image", function($bot){

	$bot->answer(new Message("image", "https://res.cloudinary.com/lilaslab/image/upload/v1588374493/logo_hjvwvb.png"));

	$bot->answer(new Message("text", "@alexpaganelli at Mindelo, S. Vicente, Cabo Verde"));

});

$myBot->hears("video", function($bot){

	$bot->answer(new Message("video", "https://www.w3schools.com/html/mov_bbb.mp4"));

});

$myBot->hears("audio", function($bot){

	$bot->answer(new Message("audio", "https://www.w3schools.com/html/horse.ogg"));

});

$myBot->confuse(function($bot){

	$bot->answer(new Message("text", "I didnt understand " . Emoji::mult(Emoji::$confused) ));

});

// respond
$myBot->respond();

?>