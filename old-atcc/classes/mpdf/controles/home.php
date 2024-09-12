<?php
require_once("../controle/Classes/home.php");
require_once("../controle/Classes/eventos.php");
require_once('../controle/Classes/ConstrucaoForm.php');
require_once('../controle/Classes/ValidacaoForm.php');
unset($_SESSION['arrEfetivo']);
unset($_SESSION['arrDevolucao']);
unset($_SESSION['arrContratacao']);
unset($_SESSION['arrFerias']);
unset($_SESSION['arrLicenca']);
unset($_SESSION['arrSupervisao']);

function Processo($Processo){

	switch ($Processo){

	case 'consultar':
	    require('../controle/includes/querys.php');
            $Construcao = new ContrucaoPage();
            $Construcao->Seguranca($_SESSION['idusuarios'], "index.php");
		
		$Home = new Home();
								
		
		global $resultado;
		global $linha;
                global $linha2;
                
                global $resultado4;
		global $linha4;
                
		global $Validacao;
		$Validacao = new ValidacaoForm();
                $Eventos= new Eventos();
	
		
		$Home->Consultar($sql_home_consulta_geral);
		$linha=$Home->Linha;
		$resultado=$Home->Result;
                
                
        $Home->Consultar($sql_home_avaliacao);
		$linha2=$Home->Linha;
		$resultado2=$Home->Result;
                
                
                $Home->Consultar($sql_Eventos_geral);
		$linha3=$Home->Linha;
		$resultado3=$Home->Result;
                
                $Home->Consultar($sql_Eventos_Hist);
		$linha4=$Home->Linha;
		$resultado4=$Home->Result;
                                
                $data_atual=strtotime('now');
		
		
                if($linha3 > 0){
                  for($d=0;$d<=$linha3;$d++){
                   $ideventos=@mysql_result($resultado3,$d,'ideventos');  
                   $dtini=strtotime(@mysql_result($resultado3,$d,'inicio'));   
                   $dtfim=strtotime(@mysql_result($resultado3,$d,'termino'));
                                     
                   if($data_atual>=$dtini){                     
                    $Eventos->AlterarSituacao("Em Aberto", $ideventos);                                              
                   }else{
                    if($data_atual>=$dtfim){                         
                     $Eventos->AlterarSituacao("Encerrado", $ideventos);                                             
                    }                        
                   }                 
                }                      
             }
	  
			
	break;
	
	}
}

?>