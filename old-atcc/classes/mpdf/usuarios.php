<?php

require_once('conexao.php');


class Usuarios {



    //Atributos da classe

    private $id_usuario;
    private $matricula;    
	private $nome;
	private $perfil;
	private $data_nascimento;
    private $cpf;
    private $rg;
    private $endereco;
	private $telefone;
	private $email;
	private $login;
	private $senha;
 



    //Método

    public function incluir($id_usuario,$matricula,$nome,$perfil,$data_nascimento,$cpf,$rg,$endereco,$telefone,$email,$login,$senha) {

         $insert = 'insert into usuarios(matricula,nome,perfil,data_nascimento,cpf,rg,endereco,telefone,email,login,senha)values("'.$matricula.'","'.$nome.'","'.$perfil.'","'.$data_nascimento.'","'.$cpf.'","'.$rg.'","'.$endereco.'","'.$telefone.'","'.$email.'","'.$login.'","'.$senha.'")';

        $insert = str_replace("'", "\'", $insert);

        $Acesso = new Acesso();

        $Acesso->Conexao();

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

    public function Alterar($id_usuario,$matricula,$nome,$perfil,$data_nascimento,$cpf,$rg,$endereco,$telefone,$email,$login,$senha){

        $update = ' update usuarios set senha="'.base64_encode($senha).'",
		 
		 
		id_usuario="'.$id_usuario.'",matricula="'.$matricula.'",nome="'.$nome.'",perfi="'.$perfil.'",data_nascimento="'.$data_nascimento.'",cpf="'.$cpf.'",rg="'.$rg.'",endereco="'.$endereco.'",telefone="'.$telefone.'",email="'.$email.'",login="'.$login.'",senha="'.$senha.'" where idusuarios="'.$id_usuario.'"';
		 
		 
		 

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