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

        $this->validaAutenticacao();//se for falso ira ser redirecionado para a página de login

         //recuperação dos tweets
         $tweet = Container::getModel('Tweet');//retorna a conexão com o banco configurada

         $tweet->__set('id_usuario', $_SESSION['id']);

         $tweets = $tweet->getAll();//retorna um array de tweets
            
         //encaminhar os tweets para a timeline
         $this->view->tweets = $tweets;//manda o array de tweets para timeline

         $this->render('timeline');    

    }


    public function tweet(){

        $this->validaAutenticacao();//se for falso ira ser redirecionado para a página de login

        $tweet = Container::getModel('Tweet');//retorna a conexão com o banco configurada
            
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_usuario', $_SESSION['id']);

        $tweet->salvar();//metodo que salva os dados setados, no banco

        header('Location: /timeline');

    }

    public function validaAutenticacao(){

        session_start();
        //veriricar se os atributos não estão setados e são diferentes de vazio
        if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
            
            header('Location: /?login=erro');//redirecionado para a página de login
        }
    }



}

?>