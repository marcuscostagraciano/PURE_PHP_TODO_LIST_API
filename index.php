<?php
require 'src/autoload.php';


$request_uri = explode('/', $_SERVER['REQUEST_URI']);
$request_endpoint = prev($request_uri);
$id_to_consult = end($request_uri);
$request_method = $_SERVER['REQUEST_METHOD'];

$request_info = [
    'METHOD' => $request_method,
    // 'ENDPOINT' => $request_endpoint,
    'ID_TO_CONSULT' => $id_to_consult,
    'PARAMS' => $_REQUEST,
    'BODY' => json_decode(file_get_contents('php://input'), true),
];

$request_handler = new RequestHandler($request_info);
$data = $request_handler->getResponse();

echo json_encode($data, JSON_NUMERIC_CHECK);
