<?php

session_start();
require_once('classes/periodoletivo.php');
require_once('classes/calendarioletivo.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../../index.php');
/* Function Processos */
global $Adm_modulos;

function Processo($Processo) {

    /* Atributos Globais */
    $util = new Util();
    $periodoletivo = new PeriodoLetivo();

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':
            global $linha;
            global $rs;

            $periodoletivo->consultar("select * from curso order by siglacurso,descricao");
            $linha = $periodoletivo->Linha;
            $rs = $periodoletivo->Result;

            if ($_POST['ok'] == 'true') {
                $periodoletivo->verificarPeriodoLetivo($_POST['siglacurso'], trim($_POST['siglaperiodo']));
                if ($periodoletivo->Achou == 'nao') {
                    try {
                        //Chamar Incluir
                        $semestre = substr($_POST['siglaperiodo'], -1);
                        $periodoletivo->consultar("BEGIN");
                        $periodoletivo->Incluir(utf8_decode($_POST['siglacurso']), $semestre, utf8_decode($_POST['siglaperiodo']), $util->formatoDataYMD($_POST['data_inicio']), $util->formatoDataYMD($_POST['data_fim']));

                        // incluindo a data do calendário de aulas
                        $calendarioletivo = new CalendarioLetivo();
                        $data_inicio = $util->formatoDataYMD($_POST['data_inicio']);
                        $data_fim = $util->formatoDataYMD($_POST['data_fim']);
                        for ($i = 0; $i < $linha; $i++) {
                            $calendarioletivo->inserirDataAulaPorPeriodo($data_inicio, $data_fim);
                        }
                        $periodoletivo->consultar("COMMIT");

                        $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                        $util->redirecionamentopage('default.php?pg=view/periodoletivo/consulta.php&form=Consulta de Período Letivo');
                    } catch (Exception $ex) {
                        $periodoletivo->consultar("ROLLBACK");
                        $util->msgbox("Falha de operacao");
                    }
                }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;

            $periodoletivo->consultar("select * from curso order by siglacurso,descricao");
            $linha2 = $periodoletivo->Linha;
            $rs2 = $periodoletivo->Result;

            if ($_POST['ok'] == 'true') {
                $periodoletivo->consultar("select *, date_format(data_inicio,'%d/%m/%Y') as dtini, date_format(data_fim,'%d/%m/%Y') as dtfim 
                    from periodoletivo where siglacurso ='" . $_POST['siglacurso'] . "' order by siglacurso, siglaperiodo desc");
                $linha = $periodoletivo->Linha;
                $rs = $periodoletivo->Result;
            }
            break;

        /* Edição de dados */
        case 'editar':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;

            $periodoletivo->consultar("select * from curso order by siglacurso,descricao");
            $linha = $periodoletivo->Linha;
            $rs = $periodoletivo->Result;

            $periodoletivo->consultar("select *,date_format(data_inicio,'%d/%m/%Y') as dtini, date_format(data_fim,'%d/%m/%Y') as dtfim from periodoletivo where idperiodoletivo=".$_GET['id']." order by siglacurso,siglaperiodo");
            $linha2 = $periodoletivo->Linha;
            $rs2 = $periodoletivo->Result;

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Incluir

                    $periodoletivo->consultar("BEGIN");
                    $semestre = substr($_POST['siglaperiodo'], -1);
                    $periodoletivo->Alterar($_GET['id'], $semestre, $_POST['siglacurso'],utf8_decode($_POST['siglaperiodo']), $util->formatoDataYMD($_POST['data_inicio']), $util->formatoDataYMD($_POST['data_fim']));
                    $data_inicio = $util->formatoDataYMD($_POST['data_inicio']);
                    $data_fim = $util->formatoDataYMD($_POST['data_fim']);
                    
                    $calendarioletivo= new CalendarioLetivo();
                    $calendarioletivo->inserirDataAulaPorPeriodo($_GET['id'],$data_inicio, $data_fim);
                    
                    $periodoletivo->consultar("COMMIT");

                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/periodoletivo/consulta.php&form=Consulta de Período Letivo');
                } catch (Exception $ex) {
                    $periodoletivo->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;
    }
}

?>