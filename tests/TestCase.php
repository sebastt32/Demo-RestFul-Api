<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function json($method, $uri, array $data = [], array $headers = [], $options = 0)
    {
        $headers['accept'] = 'application/vnd.api+json';
        return parent::json($method, $uri, $data, $headers, $options);
    }

    public function postJson($uri, array $data = [], array $headers = [], $options = 0)
    {
        $headers['content-type'] = 'application/vnd.api+json';
        return parent::postJson($uri, $data, $headers, $options);
    }

    public function patchJson($uri, array $data = [], array $headers = [], $options = 0)
    {
        $headers['content-type'] = 'application/vnd.api+json';
        parent::patchJson($uri, $data, $headers, $options);
    }
}
