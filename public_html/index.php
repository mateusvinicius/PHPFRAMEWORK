<?php

include_once "../vendor/autoload.php";


use \CORE\Routes\App;
use \Symfony\Component\HttpFoundation\Request;
use \CORE\Http\Response;
$app = new App();


$app->get("/:id",function(Request $req, Response $res){
    
    return $res->view('teste.html',[id=>$id]);

})->middleware("auth");

$app->get("/asas",function(Request $req, Response $res){
    $res->setContent("asas");
    $res->send();
});

$app->run();


