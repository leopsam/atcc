<?php
@session_start();
require('classes/classe.temas.php');
require('classes/util.php');

function Processo($Processo) {


    switch ($Processo) {
        
        case 'incluir':
		global $linha;
		global $rs;
        
        $util= new Util();
        $usuarios = new Temas();
		
		
         if($_POST['ok']=='true'){
			 $usuarios->Incluir($_POST['id_tema'],$_POST['nome'],$_POST['descricao']);
         
            $util->msgbox('Tema cadastrado com sucesso!');  
             $util->redirecionamentopage('default.php?pg=visao/administrador/temas/consultar.temas.php');  
            
         }
            
        break;  
		 
       
           case 'editar':
           global $linha;
           global $rs;
           
           $usuarios = new Temas();
		    $util= new Util();
           $usuarios->consultar("select * from temas where id_tema=".$_GET['id_tema']);
           $linha = $usuarios->Linha;
           $rs = $usuarios ->Result;
           
           if ($_POST ['ok'] == "true" ) {
                $util= new Util();
               $usuarios->Alterar($_GET['id_tema'],$_POST['nome'],$_POST['descricao']);
               
               $util->msgbox('Registro Alterado com sucesso');
               $util->redirecionamentopage('default.php?pg=visao/administrador/temas/consultar.temas.php');
           }
       
           
       }
       
       
   }
   
   


?>

