<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Classes
use App\Classes\SystemChecks\StatusChecks;

class SystemChecks
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

        StatusChecks::checkEnvVariablesExist();

        return $next($request);
    }
}
