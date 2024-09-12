<?php

require_once('conexao.php');


class Perguntas {



    //Atributos da classe

    private $id_pergunta;    
	private $descricao;
	
 



    //Método

    public function incluir($descricao) {

      $insert = 'insert into perguntas(descricao) values("'.$descricao.'")';

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

    public function alterar($id_pergunta,$descricao){

        $update = 'update perguntas set	id_pergunta="'.$id_pergunta.'",descricao="'.$descricao.'" where id_pergunta="'.$id_pergunta.'"';
		 
		 
		 

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        

    }

    

     

        }



?>