<?php

namespace SSAWeb\AppwriteLogger;

use Appwrite\Services\Functions;
use Appwrite\Enums\ExecutionMethod;

class Logger {
    private readonly string $cid;
    public function __construct(private readonly Functions $functions)
    {
        $this->cid = uniqid('cid_');
    }

    public function log(string $message, array $params = [], array $tags = [])
    {
        $body = ['message' => $message];
        if (!empty($tags)) {
            $body['tags'] = implode(',', $tags);
        }
        $body['params'] = ['cid' => $this->cid];
        if (!empty($params)) {
            $body['params'] = array_merge($params, $body['params']);
        }
        $this->functions->createExecution(
            'fnLogger',
            json_encode($body),
            async: true,
            method: ExecutionMethod::POST(),
            headers: ['content-type' => 'application/json']
        );
    }
}