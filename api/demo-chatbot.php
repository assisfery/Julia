<?php

include "../lib/WebBot.php";

use Julia\WebBot;
use Julia\Message;

// prepare
$myBot = new WebBot();
$myBot->listen();

// conversation logic
$myBot->hears("hello", function($bot){

	$bot->answer(new Message("text", "Hello my friend"));

});

$myBot->hears("bye", function($bot){

	$bot->answer(new Message("text", "See you later"));

});

// respond
$myBot->respond();

?>