<?php

include "../lib/WebBot.php";

use Julia\HttpRequest;

echo json_encode(HttpRequest::body());