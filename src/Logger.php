<?php

namespace SSAWeb\AppwriteLogger;

use Appwrite\Services\Functions;

class Logger {
    public function __construct(private readonly Functions $functions)
    {}

    public function log(string $message, array $params = [], array $tags = [])
    {
        $body = ['message' => $message];
        if (!empty($tags)) {
            $body['tags'] = implode(',', $tags);
        }
        $this->functions->createExecution(
            'fnLogger',
            json_encode(array_merge($params, $body)),
            async: true,
            method: 'POST',
            headers: ['content-type' => 'application/json']
        );
    }
}