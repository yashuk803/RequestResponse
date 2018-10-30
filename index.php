<?php
require_once('Request.php');
require_once('Response.php');
require_once('Cookie.php');



$response = new Response();
$response->status('300');
var_dump($response->status);
