<?php

require_once('vendor/autoload.php');

$data = json_decode(file_get_contents('router_data.json'));
$route = new cbulock\Simple\Router($_SERVER['REQUEST_URI'], $data, '\cbulock\task_tracker\Controller\\');
$route->get();
