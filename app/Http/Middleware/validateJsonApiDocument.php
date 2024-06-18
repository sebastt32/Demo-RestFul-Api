<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class validateJsonApiDocument
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'data' => ['required', 'array'],
                'data.type' => 'required',
                'data.attributes' => ['required', 'array'],
            ]);
        }
        return $next($request);
    }
}
