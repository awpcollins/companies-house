<?php

namespace App\Http\Middleware;

use Closure;

class Quote
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validatedData = $request->validate([
            'companyNumber' => 'required',
            'customerName' => 'required',
        ]);

        return $next($request);
    }
}
