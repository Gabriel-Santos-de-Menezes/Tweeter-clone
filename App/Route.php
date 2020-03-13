<?php

namespace App;//Especificação psr-4, espera que o namespace estaja nomaeado com o respectivo diretório

use MF\Init\Bootstrap;

class Route extends Bootstrap{
    //requiosito do sistema
    protected function initRoutes(){//para direcionar a rota 
        $routes['home'] = array(//array de configuração da rota home
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );
        $routes['inscreverse'] = array(//array de configuração da rota inscrever-se
            'route' => '/inscreverse',
            'controller' => 'indexController',
            'action' => 'inscreverse'
        );

        $routes['registrar'] = array(//array de configuração da rota registrar
            'route' => '/registrar',
            'controller' => 'indexController',
            'action' => 'registrar'
        );

        $routes['autenticar'] = array(//array de configuração da rota registrar
            'route' => '/autenticar',
            'controller' => 'AuthController',//novo controlador
            'action' => 'autenticar'
        );

        $routes['timeline'] = array(//array de configuração da rota registrar
            'route' => '/timeline',
            'controller' => 'AppController',//novo controlador
            'action' => 'timeline'
        );
        
        $this->setRoutes($routes);
    }

}

?>