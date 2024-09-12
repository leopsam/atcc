<?php 
			 session_start();
			 /* ----------------------------------------------
			 SWD 1.0
			 Criado em 04/11/2011
			 Autor: Vinícius Marques da Silva Ferreira
			 Contato:profvmarques@gmail.com
			 Projeto:sysduque  Criado em:25/09/2013
			 ----------------------------------------------*/ 
			 require_once('classes/logs.php');
			 require_once('classes/util.php');
			 $util = new Util();
			$util->Seguranca($_SESSION['idusuarios'],'../../index.php');
			 /*Function Processos*/
			 global $Logs;
			 function Processo($Processo){
			 
			 /*Atributos Globais*/
			$util = new Util();
			$logs=new Logs();
			
			 /* Switch processos*/
			 switch ($Processo){
			/*incluir*/
			 case 'incluir':
			if($_POST['ok']=='true'){
			try{
			  //Chamar Incluir
			
			 $logs->consultar("BEGIN");
			$logs->Incluir( $_POST['id'],$_POST['queryexecutada'],$_POST['dtreg'],$_POST['nome_tabela'],$_POST['acao'],$_POST['usuarioid'],$_POST['hora'] );
			 $logs->consultar("COMMIT");
			 
			$util->msgbox('REGISTRO SALVO COM SUCESSO!');
			$util->redirecionamentopage('default.php?pg=view/logs/consulta.php');
			}catch (Exception $ex) {
			 $logs->consultar("ROLLBACK");
			$util->msgbox("Falha de operacao");
			}
			 }
			 break;
			   /* Edição de dados */ 
			 case 'editar':
			 //query ok
			 global $linhaEditar;
			 global $resultadoEditar;
			$logs->consultar($sql_consulta_id);
			$linhaEditar =  $logs->Linha;
			$resultadoEditar =  $logs->Result;
			if($_POST['ok']=='true'){
			 try{
			  //Chamar Alterar
			
			 $logs->consultar("BEGIN");
			$logs->Alterar( $_GET['id'],$_POST['queryexecutada'],$_POST['dtreg'],$_POST['nome_tabela'],$_POST['acao'],$_POST['usuarioid'],$_POST['hora'] );
			 $logs->consultar("COMMIT");
			$util->msgbox('REGISTRO EDITADO COM SUCESSO!');
			$util->redirecionamentopage('default.php?pg=view/logs/consulta.php');
			}catch (Exception $ex) {
			 $logs->consultar("ROLLBACK");
			$util->msgbox("Falha de operacao");
			}
			 } 
			 break; 
			       
			 } 
			 } 
			?>