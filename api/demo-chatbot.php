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

$myBot->hears("image", function($bot){

	$bot->answer(new Message("image", "https://images.unsplash.com/photo-1548717584-eac43a401252?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"));

});

$myBot->confuse(function($bot){

	$bot->answer(new Message("text", "I didnt understand"));

});

// respond
$myBot->respond();

?>