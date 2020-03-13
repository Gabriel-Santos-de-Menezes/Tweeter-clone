<?php
//Controlador para trabalhar com a autenticação
namespace App\Controllers;

//Os recursoso do miniframework
use MF\Controller\Action;//abstração do controlador 
use MF\Model\Container;//abstração do container

//Os models

class AuthController extends Action{

    public function autenticar(){//validação do usuário

        $usuario = Container::getModel('Usuario');
        
        $usuario->__set('email', $_POST['email']);//Pegar o valor do inpute e colocar no atributo email
        $usuario->__set('senha', $_POST['senha']);//Pegar o valor do inpute e colocar no atributo email
       
        //metodo responsável, por checar no banco de dados, se o usuário existe
        $usuario->autenticar();//dados do banco já setado nos atributos

        if($usuario->__get('id') != '' && $usuario->__get('nome') != ''){
            //echo 'Autenticado';

            session_start();

            $_SESSION['id'] = $usuario->__get('id');
            $_SESSION['nome'] = $usuario->__get('nome');

            header('location: /timeline');

        }
        //Casso tenha erro, deve-se ser redirecionado para a página raiz
        else{
            header('Location: /?login=erro');
        }

    }

}


?>