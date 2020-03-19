<?php

namespace App\Models;//O nome é proporcional da localização do script

use MF\Model\Model;

class Usuario extends Model{
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __get($atrubuto){
        return $this->$atrubuto;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    //Salvar
    public function salvar(){
        $query = "insert into usuarios(nome, email, senha)values(:nome, :email, :senha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));//pegar o atributoe atribuir como indice dinâmico da query 
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));//md5() -> hash 32 caracteres
        $stmt->execute();

        return  $this;
    }


    //Validar se um cadastro pode ser feito
    public function validarCadastro(){//verifica se todos os campos estão validos
        $valido = true;
        if(strlen($this->__get('nome')) < 3){//Retorna o tamanho da string
            $valido = false;
        }
        if(strlen($this->__get('email')) < 3){//Retorna o tamanho da string
            $valido = false;
        }
        if(strlen($this->__get('senha')) < 3){//Retorna o tamanho da string
            $valido = false;
        }

        return $valido;
    }
    //recuperar um usuário por e-mail
    public function getUsuarioPorEmail(){
        $query = "select nome, email from usuarios where email = :email";//email = parametro email
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute(); 

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);//returna um array
    }

    //metodo responsável, por checar no banco de dados, se o usuário existe

    public function autenticar(){
        $query = "select id,nome, email from usuarios where email = :email and senha = :senha";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC); //pegar o registro retornado
    
        //verificar se o email e senha foram encaminhados corretamente
        if($usuario['id'] != '' && $usuario['nome'] != ''){
            $this->__set('id', $usuario['id']);
            $this->__set('nome', $usuario['nome']);
        }
        return $this;//retornar o objeto
    }

    public function getAll(){//recuperar todos os usuários com base no termo pesquisado
        
        $query = "select id, nome, email from usuarios where nome like :nome";
        $stmt = $this->db->prepare($query);

        //atribui o valor retornado do banco com o atributo nome,
        //podendo ter qualquer coisa antes e depois do nome pesquisado
        $stmt->bindValue('nome', '%'.$this->__get('nome').'%');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);//retornar a pesquisa em forma de array
    }
}

?>