<?php

namespace App\Http;
class Kernel{




    protected static $routeMiddleware =[

     'auth'=> \App\Middleware\Auth::class





    ];
} 



