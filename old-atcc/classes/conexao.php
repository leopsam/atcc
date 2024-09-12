<?php
/*
class Acesso {
    //+-------------------------------------------------------------------------------------------------------+|
      //Este metodo que vai conecta ao banco de dados
    //|+-------------------------------------------------------------------------------------------------------+

    public function conexao() {
	

		$this->cnx= mysql_connect('127.0.0.1','root','') or print ("Falha de Conectividade");
       mysql_select_db('ATCC', $this->cnx);


    }

    public function Query($sql) {
        $this->result = mysql_query($sql) or die(mysql_error());
    }

    public function __destruct() {
        @mysqli_close($this->cnx);
    }

}
*/

class Acesso {
    private $conexao;

    public function conexao() {
        // Defina as credenciais do banco de dados
        $host = '127.0.0.1'; // ou o endereço do servidor
        $user = 'root';      // seu nome de usuário
        $password = 2882; // sua senha
        $database = 'ATCC'; // nome do banco de dados

        // Crie a conexão usando mysqli
        $this->conexao = new mysqli($host, $user, $password, $database);

        // Verifique se a conexão foi bem-sucedida
        if ($this->conexao->connect_error) {
          die('Conexão falhou: ' . $this->conexao->connect_error);
      } else {
          echo 'ok, banco conectado'; // Exibe a mensagem de sucesso
      }
    }

    public function executarQuery($query) {
        return $this->conexao->query($query);
    }

    // Outras funções para manipular o banco de dados
}

?> 