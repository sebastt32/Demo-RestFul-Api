<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class JsonException extends Exception
{
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'errors' => [
                [
                    'title' => 'Error',
                    'detail' => 'Detail',
                    'source' => [
                        'pointer' => '/data/attributes',
                    ],
                ]
            ],
        ]);
    }
}
