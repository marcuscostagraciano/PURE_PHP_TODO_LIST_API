<?php

class RequestHandler {
    // Has the keys: 'METHOD', 'ENDPOINT' and 'PARAMS'.
    private int $response_code;
    private array $request;
    public array $data;

    public function __construct(array $request_info) {
        $this->request = $request_info;
    }

    public function getRequestInfo(): array {
        return $this->request;
    }

    public function getResponse() {
        switch ($this->request['METHOD']) {
            case 'POST':
                http_response_code(201);
                return DatabaseHandler::postTodo(
                    $this->request['PARAMS']['task_name'],
                    $this->request['PARAMS']['isDone'] ?? false
                );
            case 'GET':
                http_response_code(200);
                return DatabaseHandler::getTodoList();
            case 'DELETE':
                return DatabaseHandler::deleteTodo(
                    $this->request['PARAMS']['id']
                );
            case 'PATCH':
                return DatabaseHandler::patchTodo(
                    $this->request['PARAMS']['id'],
                    $this->request['PARAMS']['isDone'],
                );
            default:
                http_response_code(405);
                return ["message" => "Method not allowed"];
        }
    }
}
