<?php
session_start();
require_once('classes/eventos.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../../index.php');
/* Function Processos */
global $Adm_modulos;

function Processo($Processo) {

    /* Atributos Globais */
    $util = new Util();
    $eventos = new Eventos();

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':
            
            
            if ($_POST['ok']=='true') {
              
                try {
                      
                    $eventos->consultar("BEGIN");
                    $eventos->incluir(strtoupper($_POST['descricao']), $util->formatoDataYMD($_POST['data_inicio']), $util->formatoDataYMD($_POST['data_termino']), $_POST['situacao']);
                    $eventos->consultar("COMMIT");

                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/eventos/consulta.php&form=Consulta de Eventos');
                } catch (Exception $ex) {
                    $eventos->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
           
           } 
            break;

        case 'consulta':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;            
               
            $eventos->consultar("select *, DATE_FORMAT(e.data_inicio,'%d/%m/%Y') as inicio, DATE_FORMAT(e.data_termino,'%d/%m/%Y') as final from eventos e order by e.data_inicio desc, e.data_termino desc, e.situacao,e.descricao");
            $linha = $eventos->Linha;
            $rs = $eventos->Result;

            if ($_POST['ok'] == 'true') {
                $eventos->consultar("select *, DATE_FORMAT(e.data_inicio,'%d/%m/%Y') as inicio, DATE_FORMAT(e.data_termino,'%d/%m/%Y') as final from eventos e order by e.data_inicio desc, e.data_termino desc, e.situacao,e.descricao");
                $linha= $eventos->Linha;
                $rs= $eventos->Result;
            }
            
           
            break;

        /* Edição de dados */
        case 'editar':
            
             global $linha8;
            global $rs8;
           
            $eventos->consultar("select *,date_format(data_inicio,'%d/%m/%Y') as inicio, date_format(data_termino,'%d/%m/%Y') as final from eventos where ideventos=".$_GET['id']);
            $linha8=$eventos->Linha;
            $rs8=$eventos->Result;
            
            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Incluir

                    $eventos->consultar("BEGIN");
                    $eventos->alterar($_GET['id'],strtoupper($_POST['descricao']), $util->formatoDataYMD($_POST['data_inicio']), $util->formatoDataYMD($_POST['data_fim']),$_POST['situacao']);
                    $eventos->consultar("COMMIT");

                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/eventos/consulta.php&form=Consulta de Eventos');
                } catch (Exception $ex) {
                    $eventos->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

    }
}

?>