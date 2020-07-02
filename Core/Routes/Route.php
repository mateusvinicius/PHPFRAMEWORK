<?php

namespace CORE\Routes;

use \Symfony\Component\HttpFoundation\Request;
use \CORE\Http\Response;

class Route{

    private $middleware;
    private $url;
    private $regex;
    private $callback;
    private $method;
    private $request;
    private $response;
    private $url_param;




    function __construct(string $method,string $url,\closure $callback, Response $res,Request $req){
        $this->request =$req;
        $this->response = $res;
        $this->middleware =[];
        $this->method =$method;
        $this->url=$url;
        $this->callback = $callback;
        $this->regex = Parse::regex_path_par_url($url);
        $this->SetUrlParam();
      
    } 




    public function middleware(string $name_middleware):Route
    {
        \array_push($this->middleware,$name_middleware);
        return $this;
    }


    public function runCallback()
    {
        $response = [$this->request,$this->response];
       if(count($this->middleware)<>0)
        Middleware::runMiddleware($this->middleware,$this->request,$this->response);

       

       if(count($this->middleware)<>0)
        $response= array_merge($response,$this->url_param);
         

    
    
      return \call_user_func_array($this->callback,$response);

       
        

    }

    public function getRegex(){
        return $this->regex;
    }

    public function getUrl(){

        return $this->url;
    }

    public function method(){

        return $this->method;
    }


    private function SetUrlParam(){
        $this->url_param=Parse::checkUrlAgainstPattern($this->request->getPathInfo(),$this->url);
    }




}