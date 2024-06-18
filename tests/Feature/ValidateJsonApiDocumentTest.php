<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ValidateJsonApiDocumentTest extends TestCase
{
    use RefreshDatabase;



    protected function setUp(): void
    {
        parent::setUp();

        Route::any('test_route', fn () => 'ok')->middleware('validateJsonApiDocument');
    }
}
