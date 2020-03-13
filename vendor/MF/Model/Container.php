<?php 
//Container é responsável, com base em uma string instanciar um modelo, 
//e instamciar a classe de conexão com o banco
namespace MF\Model;

use App\Connection;//Para usar o namespace que tem a classe estática

class Container{//classes estáticas não é necessário criar os métodos
    public static function getModel($model){
        //Instânciar o moledo
        $class = "\\App\\Models\\".ucfirst($model);

        $conn = Connection::getDb();//Chamando o método de forma estática
        // retornar o modelo solicitado já instanciado, com a conexão estabelecida
        return new $class($conn);
    }
}
?>