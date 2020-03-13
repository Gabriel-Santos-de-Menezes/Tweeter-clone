<?php

//Controlador para trabalhar com páginas externas da aplicação, como a home e o formulario
namespace App\Controllers;

//Os recursoso do miniframework
use MF\Controller\Action;
use MF\Model\Container;

//Os models

class IndexController extends Action{

    public function index(){

        //caso o login não ocasione um erro, não passa-se o erro na url via get
        $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
        $this->render('index');
    }

    public function inscreverse(){

        $this->view->usuario = array(
            'nome' => '',
            'email' => '',
            'senha' => '',
        );

        $this->view->erroCadastro = false;//atributo criado dinamicamente apartir do extends de Action, 
        
        $this->render('inscreverse');
    }

    public function registrar(){

        //Instância de usuário com a conexão com o banco a partir de container 
        $usuario = Container::getModel('Usuario');

        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', $_POST['senha']);

        //sucesso
        if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0){
           //se não conter outro usuário com o mesmo email, deve-se salvar
            
           $usuario->salvar();//gravar dados no banco

            $this->render('cadastro');//view de sucesso
        }
        //erro
        else{
            
            $this->view->usuario = array(
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'senha' => $_POST['senha']
            );

            $this->view->erroCadastro = true;//atributo criado dinamicamente apartir do extends de Action, 

            $this->render('inscreverse');
        }
    }
}
?>