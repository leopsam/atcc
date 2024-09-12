<?php

require_once('conexao.php');


class Temas {



    //Atributos da classe

    private $id_tema;    
	private $nome;
	private $descricao;
	
 



    //Método

    public function incluir($id_tema,$nome,$descricao) {

      $insert = 'insert into temas(id_tema,nome,descricao) values("'.$id_tema.'","'.$nome.'","'.$descricao.'")';

        $insert = str_replace("'", "\'", $insert);

        $Acesso = new Acesso();

        $Acesso->conexao();

        $Acesso->Query($insert); 

       
     
    }



    

 

    //consultar

    public function consultar($sql) {

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($sql);

        $this->Linha = @mysql_num_rows($Acesso->result);

        $this->Result = $Acesso->result;

    }




    

       //Editar

    public function alterar($id_tema,$nome,$descricao){

        $update = 'update temas set	id_tema="'.$id_tema.'",nome="'.$nome.'",descricao="'.$descricao.'" where id_tema="'.$id_tema.'"';
		 
		 
		 

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        

    }

    

     

        }



?>