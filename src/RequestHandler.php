<?php

class RequestHandler
{
    // Has the keys: 'METHOD', 'ID', 'PARAMS' and 'BODY'.
    private array $request;

    public function __construct(array $request_info)
    {
        $this->request = $request_info;
    }

    public function getRequestInfo(): array
    {
        return $this->request;
    }

    public function getResponse(): ?array
    {
        if ($this->request['METHOD'] == 'OPTIONS') {
            $CACHED_MINUTES_OF_PREFLIGHT_REQUEST = 60;

            http_response_code(200);
            header('Access-Control-Allow-Methods: DELETE, GET, PATCH, POST');
            header("Access-Control-Max-Age: 60 * $CACHED_MINUTES_OF_PREFLIGHT_REQUEST");
            return;
        }

        return Todo::handleTodoRequest($this->request);
    }
}
