<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateJsonApiHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('accept') !== 'application/vnd.api+json') {
            throw new HttpException(406, __('Accept header must be present in all requests'));
        }

        if ($request->isMethod('post') || $request->isMethod('patch')) {
            if ($request->header('content-type') !== 'application/vnd.api+json') {
                throw new HttpException(415, __('Content-Type header must be present on all posts requests'));
            }
        }

        return $next($request)->withHeaders([
            'content-type' => 'application/vnd.api+json',
        ]);
    }
}
