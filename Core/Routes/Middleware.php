<?php

namespace CORE\Routes;



Class Middleware extends \App\Http\Kernel{


    
    public static function runMiddleware(array $listMiddleware, &$request, &$response){
        foreach($listMiddleware as $middleware){
            $response = self::call($middleware,$request,$response,function($request,$response){
                return $response;
            });
        }

    }
    public static function call($middleware,$request,$response, \Closure $next){

       // $class = \ReflectionMethod(self::$routeMiddleware[$middleware],'handle');

        //echo self::$routeMiddleware[$middleware];
        //var_dump($class);

        return \call_user_func_array([self::$routeMiddleware[$middleware],'handle'],[$request,$response,$next]);
    }

}