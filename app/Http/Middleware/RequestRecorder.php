<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RequestRecorder
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
        $route = $request->route();

        // recorder
        $requestRecorder = new \App\Models\System\RequestRecorder();
        $requestRecorder->user_id       =   Auth::id() ?: null;
        $requestRecorder->session_id    =   session()->getId();
        $requestRecorder->url           =   $request->url();
        $requestRecorder->path          =   $request->path();
        $requestRecorder->ip            =   $request->ip();
        $requestRecorder->method        =   $request->method();
        $requestRecorder->params        =   json_encode($request->all());
        $requestRecorder->route_name    =   $route->getName();
        $requestRecorder->controller_name   =   $route->getAction('controller');
        $requestRecorder->save();

        return $next($request);
    }
}
