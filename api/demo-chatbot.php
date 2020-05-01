<?php

include "../lib/WebBot.php";

use Julia\WebBot;
use Julia\Message;

$myBot = new WebBot();

$myBot->listen();

$myBot->hears("hello", function($bot){

	$bot->answer(new Message("text", "Hello my friend"));

});

$myBot->hears("bye", function($bot){

	$bot->answer(new Message("text", "See you later"));

});

$myBot->respond();


?>