<?php
namespace CORE\Http;


Class Response extends \Symfony\Component\HttpFoundation\Response {

    function __construct(){
        $this->$loader =  new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT']."/../App/Views/");
        $this->twig = new \Twig\Environment($this->$loader,[
            'cache'=> false
        ]);
    }


    public function view(string $name,array $dados=[]){

        echo $this->twig->render($name,$dados);
    }




}