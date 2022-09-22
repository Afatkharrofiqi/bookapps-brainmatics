<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RecordAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // AccessLogger::insert([
        //     'user_id' => auth()->user()->id,
        //     'url' => $request->url()
        // ]);

        return $next($request);
    }
}
