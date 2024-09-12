<?php
@session_start();
require('classes/classe.usuarios.php');
require('classes/util.php');

function Processo($Processo) {


    switch ($Processo) {
        
        case 'incluir':
		global $linha;
		global $rs;
        
        $util= new Util();
        $usuarios = new Usuarios();
		
		
         if($_POST['ok']=='true'){
			 $usuarios->Incluir($_POST['matricula'],$_POST['nome'],$_POST['perfil'],$_POST['situacao'],$_POST['data_nascimento'],$_POST['cpf'],$_POST['rg'],$_POST['endereco'],$_POST['telefone'],$_POST['email'],$_POST['login'],$_POST['senha'],$_POST['foto']);
         
            $util->msgbox('Usuario cadastrado com sucesso!');  
             $util->redirecionamentopage('default.php?pg=visao/administrador/usuarios/consultar.usuarios.php');  
            
         }
            
        break;  
		 
       
           case 'editar':
           global $linha;
           global $rs;
           
           $usuarios = new Usuarios();
		    $util= new Util();
           $usuarios->consultar("select * from usuarios where id=".$_GET['id']);
           $linha = $usuarios->Linha;
           $rs = $usuarios ->Result;
           
           if ($_POST ['ok'] == "true" ) {
                $util= new Util();
               $usuarios->Alterar($_GET['id'],$_POST['matricula'],$_POST['nome'],$_POST['perfil'],$_POST['situacao'],$_POST['data_nascimento'],$_POST['cpf'],$_POST['rg'],$_POST['endereco'],$_POST['telefone'],$_POST['email'],$_POST['login'],$_POST['senha']);
               
               $util->msgbox('Registro Alterado com sucesso');
               $util->redirecionamentopage('default.php?pg=visao/administrador/usuarios/consultar.usuarios.php');
           }
       
           
       }
       
       
   }
   
   


?>

