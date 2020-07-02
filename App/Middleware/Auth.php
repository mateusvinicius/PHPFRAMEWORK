<?php 

namespace App\Middleware;
use \Symfony\Component\HttpFoundation\Request;
use \CORE\Http\Response;


class Auth implements Middleware{

    public function handle(Request $request ,Response $response,\Closure $next):Response{
     
        return $next($request,$response);
    }
}