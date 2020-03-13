<?php
namespace MF\Model;

abstract class Model{//Diz como é feita a conexão com o banco de dados
    protected $db;

    public function __construct(\PDO $db){
        $this->db = $db;
    }
}

?>