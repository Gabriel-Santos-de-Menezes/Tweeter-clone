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

            $this->render('timeline');
        }
        else{
            header('Location: /?login=erro');
        }

    }



}

?>