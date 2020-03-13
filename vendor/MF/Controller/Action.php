<?php
namespace MF\Controller;

abstract class Action{
    protected $view;

    public function __construct(){
        $this->view = new \stdClass();//Nativa do php, que cria obj padrões(vazios), que podem ser atribuidos atributos dinamicamente
    }

    protected function render($view, $layout ='layout'){//receber qual que é a view, para fazer
        // o preocesso de require
        $this->view->page = $view;

        if(file_exists("../App/Views/".$layout.".phtml")){
            require_once "../App/Views/".$layout.".phtml";
        }else{
            $this->content();
        }

    }

    protected function content(){//Logica de renderização o layout
        $classAtual = get_class($this);//Passa-se uma classe, e retorna o nome dessa classe
        $classAtual = str_replace('App\\Controllers\\', '', $classAtual);//pega a string e atribui vazio

        $classAtual = strtolower(str_replace('Controller', '', $classAtual));

        require_once "../App/Views/".$classAtual ."/".$this->view->page.".phtml";
    }


}
?>