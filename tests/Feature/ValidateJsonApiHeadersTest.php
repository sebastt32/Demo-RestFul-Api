<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ValidateJsonApiHeadersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function accept_header_must_be_present_in_all_requests(): void
    {
        Route::get('test_route', function () {
            return 'ok';
        })->middleware('validateJsonApiHeaders');

        $this->get('test_route')->assertStatus(406);


        $this->get('test_route', [
            'accept' => 'application/vnd.api+json',
        ])->assertSuccessful();
    }
    /**
     * @test
     */
    public function content_type_header_must_be_present_on_all_posts_requests(): void
    {
        Route::post('test_route', function () {
            return 'ok';
        })->middleware('validateJsonApiHeaders');

        $this->post('test_route', [], ['accept' => 'application/vnd.api+json'])->assertStatus(415);


        $this->post('test_route', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json',
        ])->assertSuccessful();
    }

    public function content_type_header_must_be_present_on_all_patch_requests(): void
    {
        Route::patch('test_route', function () {
            return 'ok';
        })->middleware('validateJsonApiHeaders');

        $this->patch('test_route', [], ['accept' => 'application/vnd.api+json'])->assertStatus(415);


        $this->patch('test_route', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json',
        ])->assertSuccessful();
    }

    /**
     * @test
     */
    function content_type_header_must_be_present_in_responses()
    {
        Route::any('test_route', function () {
            return 'ok';
        })->middleware('validateJsonApiHeaders');

        $this->get('test_route', [
            'accept' => 'application/vnd.api+json',
        ])->assertHeader('content-type', 'application/vnd.api+json');

        $this->post('test_route', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json',

        ])->assertHeader('content-type', 'application/vnd.api+json');

        $this->patch('test_route', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json',

        ])->assertHeader('content-type', 'application/vnd.api+json');
    }

    function content_type_header_must_not_be_present_in_empty_esponses()
    {
    }
}
