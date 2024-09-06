<?php
require 'src/autoload.php';


$request_uri = explode('/', $_SERVER['REQUEST_URI']);
// 0 is an empty string. 1 is the folder name. 2 is the endpoint
$request_endpoint = $request_uri[2];
$request_method = $_SERVER['REQUEST_METHOD'];

$request_info = [
    'METHOD' => $request_method,
    'ENDPOINT' => $request_endpoint,
    'PARAMS' => $_REQUEST,
];

$request_handler = new RequestHandler($request_info);
$data = $request_handler->getResponse();

echo json_encode($data);
