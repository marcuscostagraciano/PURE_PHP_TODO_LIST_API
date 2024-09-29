<?php
require 'src/autoload.php';


$request_uri = explode('/', $_SERVER['REQUEST_URI']);
// 0 is an empty string. 1 is the folder name. 2 is the endpoint
$request_endpoint = $request_uri[2];
$id_to_consult = $request_uri[3] ?? null;
$request_method = $_SERVER['REQUEST_METHOD'];

$request_info = [
    'METHOD' => $request_method,
    'ENDPOINT' => $request_endpoint,
    'IDTOCONSULT' => $id_to_consult,
    'PARAMS' => $_REQUEST,
    'BODY' => json_decode(file_get_contents('php://input')),
];

$request_handler = new RequestHandler($request_info);
$data = $request_handler->getResponse();

echo json_encode($data, JSON_NUMERIC_CHECK);
