<?php

session_start();
require_once('classes/temposemanal.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../../index.php');

function Processo($Processo) {

    /* Atributos Globais */
    $util = new Util();

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;

            $temposemanal = new TempoSemanal();

            $temposemanal->consultar("select * from curso order by siglacurso");
            $linha = $temposemanal->Linha;
            $rs = $temposemanal->Result;

            $temposemanal->consultar("select * from turno");
            $linha2 = $temposemanal->Linha;
            $rs2 = $temposemanal->Result;


            if ($_POST['ok'] == 'true') {
                try {
                    $i = 0;
                    if (sizeof($_POST['siglacurso']) > 0 && $_POST['siglacurso'][$i] != '') {

                        foreach ($_POST['siglacurso'] as $i => $v) {
                            for ($a = 1; $a < 7; $a++) {
                                $diasemana=$util->diaSemanaAbreviadoIndice($a);
                                $temposemanal->consultar("BEGIN");
                                $temposemanal->Incluir($_POST['siglacurso'][$i], $_POST['idturno'][$i], $_POST['horainicio'][$i], $_POST['horafim'][$i], $diasemana);
                                $temposemanal->consultar("COMMIT");
                            }
                        }
                    }
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/temposemanal/consulta.php&form=Lista de Tempo Semanal');
                } catch (Exception $ex) {
                    $temposemanal->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;
            $temposemanal->consultar("select * from espaco order by descricao");
            $linha = $temposemanal->Linha;
            $rs = $temposemanal->Result;


            break;

        /* Edição de dados */
        case 'editar':
            global $linha;
            global $rs;

            $temposemanal->consultar("select * from temposemanal where idtemposemanal='" . $_GET['id'] . "'");
            $linha = $temposemanal->Linha;
            $rs = $temposemanal->Result;

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Alterar

                    $temposemanal->consultar("BEGIN");
                    $temposemanal->Alterar($_GET['id'], utf8_decode($_POST['descricao']), $_POST['capacidade']);
                    $temposemanal->consultar("COMMIT");
                    $util->msgbox('REGISTRO EDITADO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/espaco/consulta.php&form=Lista de espaço');
                } catch (Exception $ex) {
                    $temposemanal->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;
    }
}

?>