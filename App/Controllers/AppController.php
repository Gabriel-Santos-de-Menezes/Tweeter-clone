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

         $tweets = $tweet->getAll();//retorna um array de todos os tweets
            
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


    public function quemSeguir(){
        //ver se a autenticação foi realizada
        $this->validaAutenticacao();//se for falso ira ser redirecionado para a página de login
        
        //if ternário
        $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

        $usuarios = array();

        if($pesquisarPor != ''){
            
            $usuario = Container::getModel('Usuario');//retorna um obj com a conexão com banco de dados
            $usuario->__set('nome', $pesquisarPor);//setar o valor recebido pela pesquisa no banco de dados
            $usuario->__set('id', $_SESSION['id']);//setar o valor recebido pela pesquisa no banco de dados
            $usuarios = $usuario->getAll();//retorna um array com os usuarios pesquisados
        

            }
        
        $this->view->usuarios = $usuarios;
        
        $this->render('quemSeguir');


    }

    public function acao(){
        $this->validaAutenticacao();

        //acao
        //if ternário, caso o valor não seja vazio, a variavel acao recebe o parametro passado polo get, caso esteja vazia, recebe vazio
        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        //id_usuario
        $id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

        $usuario = Container::getModel('Usuario');//Instancia do modelo Usuario
        $usuario->__set('id', $_SESSION['id']);//setando id so usuário ao atributo id

        if($acao == 'seguir'){
            $usuario->seguirUsuario($id_usuario_seguindo);
        }else if($acao =='deixar_de_seguir'){
            $usuario->deixarSeguirUsuario($id_usuario_seguindo);
        }

        header('Location: /quem_seguir');

    }



}

?>