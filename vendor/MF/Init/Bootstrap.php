<?php
//Estrutura da aplicação
//Scripts de inicialização

namespace MF\Init;
//Classe abstrata é definida de forma análoga a 
//qualquer tipo de classe, porém ela não pode ser
//instânciada, pode ser apenas herdada


abstract class Bootstrap{
    private $routes;

    abstract protected function initRoutes();

    public function __construct(){
        $this->initRoutes();//Iniciar as rotas
        $this->run($this->getUrl());
    }
    
    public function getRoutes(){
        return $this->routes;
    }
    
    public function setRoutes(array $routes){
        $this->routes = $routes;
    }

    protected function run($url){//verificar se a url passada é a mesma que a rota a ser seguida
        foreach ($this->getRoutes() as $kay => $route){
            if($url == $route['route']){
                $class ="App\\Controllers\\".ucfirst($route['controller']);

                $controller = new $class;//Instânciar o controlador de forma dinâmica

                $action = $route['action'];//Acionar a acão de forma dinâmica

                $controller->$action();
            }
        }
    }

    protected function getUrl(){
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);//retorna o caminho da url
    }
}


?>