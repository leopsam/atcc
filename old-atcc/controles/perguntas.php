<?php
@session_start();
require('classes/classe.perguntas.php');
require('classes/util.php');

function Processo($Processo) {


    switch ($Processo) {
        
        case 'incluir':
		global $linha;
		global $rs;
        
        $util= new Util();
        $usuarios = new Perguntas();
		
		
         if($_POST['ok']=='true'){
			 $usuarios->Incluir($_POST['descricao']);
         
            $util->msgbox('Pergunta cadastrado com sucesso!');  
             $util->redirecionamentopage('default.php?pg=visao/administrador/rank/consultar.perguntas.php');  
            
         }
            
        break;  
		 
       
           case 'editar':
           global $linha;
           global $rs;
           
           $usuarios = new Perguntas();
		    $util= new Util();
           $usuarios->consultar("select * from perguntas where id_pergunta=".$_GET['id_pergunta']);
           $linha = $usuarios->Linha;
           $rs = $usuarios ->Result;
           
           if ($_POST ['ok'] == "true" ) {
                $util= new Util();
               $usuarios->Alterar($_GET['id_pergunta'],$_POST['descricao']);
               
               $util->msgbox('Registro Alterado com sucesso');
               $util->redirecionamentopage('default.php?pg=visao/administrador/rank/consultar.perguntas.php');
           }
       
           
       }
       
       
   }
   
   


?>

