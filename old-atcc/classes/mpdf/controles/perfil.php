<?php 
			 session_start();
			 /* ----------------------------------------------
			 SWD 1.0
			 Criado em 04/11/2011
			 Autor: Vinícius Marques da Silva Ferreira
			 Contato:profvmarques@gmail.com
			 Projeto:sysduque  Criado em:25/09/2013
			 ----------------------------------------------*/ 
			 require_once('classes/perfil.php');
			 require_once('classes/util.php');
			 $util = new Util();
			$util->Seguranca($_SESSION['idusuarios'],'../../index.php');
			 /*Function Processos*/
			 global $Perfil;
			 function Processo($Processo){
			 
			 /*Atributos Globais*/
			$util = new Util();
			$perfil=new Perfil();
			
			 /* Switch processos*/
			 switch ($Processo){
			/*incluir*/
			 case 'incluir':
			if($_POST['ok']=='true'){
			try{
			  //Chamar Incluir
			
			 $perfil->consultar("BEGIN");
			$perfil->Incluir( $_POST['idperfil'],$_POST['descricao'],$_POST['dtreg'] );
			 $perfil->consultar("COMMIT");
			 
			$util->msgbox('REGISTRO SALVO COM SUCESSO!');
			$util->redirecionamentopage('default.php?pg=view/perfil/consulta.php');
			}catch (Exception $ex) {
			 $perfil->consultar("ROLLBACK");
			$util->msgbox("Falha de operacao");
			}
			 }
			 break;
			   /* Edição de dados */ 
			 case 'editar':
			 //query ok
			 global $linhaEditar;
			 global $resultadoEditar;
			$perfil->consultar($sql_consulta_id);
			$linhaEditar =  $perfil->Linha;
			$resultadoEditar =  $perfil->Result;
			if($_POST['ok']=='true'){
			 try{
			  //Chamar Alterar
			
			 $perfil->consultar("BEGIN");
			$perfil->Alterar( $_GET['idperfil'],$_POST['descricao'],$_POST['dtreg'] );
			 $perfil->consultar("COMMIT");
			$util->msgbox('REGISTRO EDITADO COM SUCESSO!');
			$util->redirecionamentopage('default.php?pg=view/perfil/consulta.php');
			}catch (Exception $ex) {
			 $perfil->consultar("ROLLBACK");
			$util->msgbox("Falha de operacao");
			}
			 } 
			 break; 
			       
			 } 
			 } 
			?>