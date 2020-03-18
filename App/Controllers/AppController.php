<?php
//Controlador para trabalhar com as páginas restritas
//configuadas conforme o usuário autenticado

namespace App\Controllers;

//Os recursoso do miniframework
use MF\Controller\Action;//abstração do controlador 
use MF\Model\Container;//abstração do container

//Os models

class AppController extends Action{

    public function timeline(){
        session_start();

        if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){

            //recuperação dos tweets
            $tweet = Container::getModel('Tweet');//retorna a conexão com o banco configurada

            $tweet->__set('id_usuario', $_SESSION['id']);

            $tweets = $tweet->getAll();//retorna um array de tweets
           
            //encaminhar os tweets para a timeline
            $this->view->tweets = $tweets;//manda o array de tweets para timeline

            $this->render('timeline');
        }
        else{
            header('Location: /?login=erro');
        }

    }


    public function tweet(){

        session_start();

        if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){
        
            $tweet = Container::getModel('Tweet');//retorna a conexão com o banco configurada
            
            $tweet->__set('tweet', $_POST['tweet']);
            $tweet->__set('id_usuario', $_SESSION['id']);

            $tweet->salvar();

            header('Location: /timeline');

        }

        else{
            header('Location: /?login=erro');
        }

    }

    public function validaAutenticacao(){
        if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){
            return true;
        }else{
            header('Location: /?login=erro');
        }
    }



}

?>