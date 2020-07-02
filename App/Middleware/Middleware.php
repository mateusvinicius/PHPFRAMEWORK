<?php 

namespace App\Middleware;
use \Symfony\Component\HttpFoundation\Request;
use \CORE\Http\Response;

interface Middleware {

    public function handle(Request $request ,Response $response,\Closure $next):Response;
}