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

        $routes['autenticar'] = array(//array de configuração da rota autenticar
            'route' => '/autenticar',
            'controller' => 'AuthController',//novo controlador
            'action' => 'autenticar'
        );

        $routes['timeline'] = array(//array de configuração da rota timeline
            'route' => '/timeline',
            'controller' => 'AppController',//novo controlador
            'action' => 'timeline'
        );

        $routes['sair'] = array(//array de configuração da rota sair
            'route' => '/sair',
            'controller' => 'AuthController',//novo controlador
            'action' => 'sair'
        );


        $routes['tweet'] = array(//array de configuração da rota tweet
            'route' => '/tweet',
            'controller' => 'AppController',//novo controlador
            'action' => 'tweet'
        );
        
        $this->setRoutes($routes);
    }

}

?>