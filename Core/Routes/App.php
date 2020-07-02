<?php

namespace CORE\Routes;


class App{

    private $methods_val =["GET","POST"];
    private $routes=[];
    private $request;
    private $response;

    function __construct(){
        $this->request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $this->response = new \CORE\Http\Response();
    }


    public function __call($method,$args):Route{
        if(in_array($method = strtoupper($method), $this->methods_val)){
            [$url,$callback] = $args;
            $route = new Route($method,$url,$callback,$this->response,$this->request);
            array_push($this->routes,$route);
          return $route; 
        }
    }



    public function run(){

       
        foreach($this->routes as $key=>$value){

          if($value->method() ==$this->request->server->all()['REQUEST_METHOD']){
            
            
              if(preg_match($value->getRegex(),$this->request->getPathInfo())){
                $value->runCallback(); 
              }

          }
        }

        
    }



    
}