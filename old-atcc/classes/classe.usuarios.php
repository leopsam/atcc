<?php

require_once('conexao.php');


class Usuarios {



    //Atributos da classe

    private $id;
    private $matricula;    
	private $nome;
	private $perfil;
	private $situacao;
	private $data_nascimento;
    private $cpf;
    private $rg;
    private $endereco;
	private $telefone;
	private $email;
	private $login;
	private $senha;
	private $foto;
 



    //Método

    public function incluir($matricula,$nome,$perfil,$situacao,$data_nascimento,$cpf,$rg,$endereco,$telefone,$email,$login,$senha,$foto) {

          $insert = 'insert into usuarios(matricula,nome,perfil,situacao,data_nascimento,cpf,rg,endereco,telefone,email,login,senha,foto)
		 			values("'.$matricula.'","'.$nome.'","'.$perfil.'","'.$situacao.'","'.$data_nascimento.'","'.$cpf.'","'.$rg.'","'.$endereco.'","'.$telefone.'","'.$email.'","'.$login.'","'.$senha.'","'.$foto.'")';

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

    public function alterar($id,$matricula,$nome,$perfil,$situacao,$data_nascimento,$cpf,$rg,$endereco,$telefone,$email,$login,$senha){

        $update = 'update usuarios set	
		matricula="'.$matricula.'",
		nome="'.$nome.'",
		perfil="'.$perfil.'",
		situacao="'.$situacao.'",
		data_nascimento="'.$data_nascimento.'",
		cpf="'.$cpf.'",
		rg="'.$rg.'",
		endereco="'.$endereco.'",
		telefone="'.$telefone.'",
		email="'.$email.'",
		login="'.$login.'",
		senha="'.$senha.'" 
		where id="'.$id.'"';
		 
		 
		 

        $Acesso = new Acesso();

        $Acesso->Conexao();

        $Acesso->Query($update);

        

    }

    

      
    

     public function verificarlogin($login) {

        $sql = " select * from usuarios where login='".$login."'";

        $this->consultar($sql);

        if ($this->Linha > 0) {

            $util = new Util();

            $util->Msgbox("login ja cadastrado na base de dados!");

            $this->Achou = 'sim';

        } else {

            $this->Achou = 'nao';

        }

    }





}



?>