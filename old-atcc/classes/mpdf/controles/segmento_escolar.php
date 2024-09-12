<?php
session_start();
require_once('classes/segmento_escolar.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../../index.php');

function Processo($Processo) {

    /* Atributos Globais */
    $util = new Util();
    $segmento = new SegmentoEscolar();

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':
            global $linha2;
            global $rs2;
            $segmento->consultar("select * from tiposegmento order by descricao");
            $linha2 = $segmento->Linha;
            $rs2 = $segmento->Result;
                      
            if ($_POST['ok'] == 'true') {
                $segmento->verificar(utf8_decode(strtoupper($_POST['descricao'])));
               if($segmento->Achou == 'nao') {      
                try {
                    //Chamar Incluir

                    $segmento->consultar("BEGIN");
                    $segmento->incluir(utf8_decode(strtoupper($_POST['descricao'])),$_POST['idtipo_segmento']);
                    $segmento->consultar("COMMIT");

                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/segmento_escolar/consulta.php&form=Consulta de Segmento Escolar');
                } catch (Exception $ex) {
                    $segmento->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
               }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;
            
                        
            $segmento->consultar("select * from segmentoescolar order by descricao");
            $linha = $segmento->Linha;
            $rs = $segmento->Result;

            if ($_POST['ok'] == 'true') {
                $segmento->consultar("select * from curso where descricao like '%" . $_POST['descricao'] . "%' order by descricao");
                $linha = $segmento->Linha;
                $rs = $segmento->Result;
            }
            break;

        /* Edição de dados */
        case 'editar':
            //query ok
            global $linhaEditar;
            global $resultadoEditar;
            global $linha2;
            global $rs2;
            $segmento->consultar("select * from tiposegmento order by descricao");
            $linha2 = $segmento->Linha;
            $rs2 = $segmento->Result;
         
            $segmento->consultar("select * from segmentoescolar where idsegmento_escolar='".$_GET['id']."'");
            $linhaEditar = $segmento->Linha;
            $resultadoEditar = $segmento->Result;
            
            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Alterar

                    $segmento->consultar("BEGIN");
                    $segmento->alterar(utf8_decode($_GET['id']), utf8_decode(strtoupper($_POST['descricao'])), $_POST['idtipo_segmento']);
                    $segmento->consultar("COMMIT");
                    $util->msgbox('REGISTRO EDITADO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/segmento_escolar/consulta.php&form=Consulta de Segmento Escolar');
                } catch (Exception $ex) {
                    $segmento->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;
    }
}

?>