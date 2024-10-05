<?php

class RequestHandler
{
    // Has the keys: 'METHOD', 'ENDPOINT' and 'PARAMS'.
    private array $request;

    public function __construct(array $request_info)
    {
        $this->request = $request_info;
    }

    public function getRequestInfo(): array
    {
        return $this->request;
    }

    public function getResponse(): array
    {
        return Todo::handleTodoRequest($this->request);
    }
}
