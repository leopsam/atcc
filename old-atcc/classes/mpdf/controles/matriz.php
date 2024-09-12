<?php

session_start();
require_once('classes/matriz.php');
require_once('classes/disciplinas.php');
require_once('classes/componentecurricular.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../../index.php');

function Processo($Processo) {

    $util = new Util();
    $matriz = new Matriz();
    $disciplinas = new Disciplinas();
    $cc = new ComponenteCurricular();


    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;

            $matriz->consultar("select * from curso order by siglacurso, descricao");
            $linha = $matriz->Linha;
            $rs = $matriz->Result;

            $matriz->consultar("select * from disciplinas order by descricao");
            $linha2 = $matriz->Linha;
            $rs2 = $matriz->Result;

            $matriz->consultar("select * from tipocomponente order by descricao");
            $linha3 = $matriz->Linha;
            $rs3 = $matriz->Result;

            if ($_POST['ok'] == 'true') {
                $matriz->verificar($_POST['siglacurso'], $_POST['parecer'], $util->formatoDataYMD($_POST['data_vigencia']));
                if ($matriz->Achou == 'nao') {
                    try {
                        //Chamar Incluir

                        $matriz->consultar("BEGIN");
                        $idmatriz = $matriz->Incluir($_POST['siglacurso'], $_POST['parecer'], $util->formatoDataYMD($_POST['data_vigencia']));

                        $sigladisciplina = $_POST['sigladisciplina'];
                        $i = 0;

                        if (sizeof($sigladisciplina) > 0 && $_POST['sigladisciplina'][$i] != '') {
                            foreach ($sigladisciplina as $i => $v) {
                                /*$disciplinas->verificar($_POST['sigladisciplina'][$i], $_POST['descricao'][$i]);
                                if ($disciplinas->Achou == 'nao') {
                                    $disciplinas->Incluir($_POST['sigladisciplina'][$i], $_POST['descricao'][$i]);
                                }*/

                                $cc->Incluir($idmatriz, strtoupper($_POST['siglacurso']), utf8_decode(strtoupper($_POST['sigladisciplina'][$i])), utf8_decode(strtoupper($_POST['descricao'][$i])),$_POST['creditos'][$i], $_POST['ch'][$i], $_POST['periodo'][$i], $_POST['idtipocomponente'][$i]);
                                $matriz->consultar("COMMIT");
                            }
                        }

                        $util->Msgbox('REGISTRO SALVO COM SUCESSO!');
                        $util->redirecionamentopage('default.php?pg=view/matrizcurricular/consulta.php&form=Consulta de Matriz Curricular');
                    } catch (Exception $ex) {
                        $matriz->consultar("ROLLBACK");
                        $util->msgbox("Falha de operacao");
                    }
                }
            }
            break;

        /* Consulta de dados */
        case 'consultar':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $linha0;
            global $arr;
            global $count;
            $count = 0;
            $arr = array();

            $matriz->consultar("select * from curso order by siglacurso, descricao");
            $linha = $matriz->Linha;
            $rs = $matriz->Result;

            $matriz->consultar("select * from turno order by descricao");
            $linha2 = $matriz->Linha;
            $rs2 = $matriz->Result;

            if ($_POST['ok'] == 'true') {
                
            }
            break;

        case 'editar':

            ini_set("max_execution_time", 120000);
            ini_set("memory_limit", "400M");
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;

            $matriz->consultar("select * from curso order by siglacurso, descricao");
            $linha = $matriz->Linha;
            $rs = $matriz->Result;

            $matriz->consultar("select *, DATE_FORMAT(m.data_vigencia,'%d/%m/%Y') as vigencia from matriz m inner join componentecurricular cc on(m.idmatriz=cc.idmatriz) "
                    . "where m.siglacurso='" . $_GET['siglacurso'] . "' and m.idmatriz=" . $_GET['idmatriz'] . " order by cc.periodo, cc.sigladisciplina, cc.descricao");
            $linha2 = $matriz->Linha;
            $rs2 = $matriz->Result;

            $matriz->consultar("select * from tipocomponente order by descricao");
            $linha3 = $matriz->Linha;
            $rs3 = $matriz->Result;

            if ($_POST['ok'] == 'true') {
                
                    try {
                        //Chamar Incluir

                        $matriz->consultar("BEGIN");
                  
                        $idmatriz =mysql_result($rs2,0,'m.idmatriz');
                        
                        $matriz->Alterar($idmatriz, $_POST['siglacurso'], $_POST['parecer'], $util->formatoDataYMD($_POST['data_vigencia']));
                        $matriz->consultar("COMMIT");
                        for($x=0;$x<$linha2;$x++){
                           $siglacursoAntes= mysql_result($rs2,$x,'cc.siglacurso'); 
                           $sigladisciplinaAntes= mysql_result($rs2,$x,'cc.sigladisciplina'); 
                           
                           //$disciplinas->Alterar($sigladisciplinaAntes,$_POST['sigladisciplina'.$x], $_POST['descricao'.$x]);
                           $cc->Alterar($idmatriz, $siglacursoAntes,$sigladisciplinaAntes,strtoupper($_POST['siglacurso']), strtoupper($_POST['sigladisciplina'.$x]), utf8_decode(strtoupper($_POST['descricao'.$x])),$_POST['creditos'.$x], $_POST['ch'.$x], $_POST['periodo'.$x], $_POST['idtipocomponente'.$x]);
                           $matriz->consultar("COMMIT"); 
                        }
                        
                        $sigladisciplina = $_POST['sigladisciplina'];
                        $i = 0;

                        if (sizeof($sigladisciplina) > 0 && $_POST['sigladisciplina'][$i] != '' && $_POST['descricao'][$i] != '') {
                            foreach ($sigladisciplina as $i => $v) {
                                //$disciplinas->verificar($_POST['sigladisciplina'][$i], $_POST['descricao'][$i]);
                               /* if ($disciplinas->Achou == 'nao') {
                                    $disciplinas->Incluir($_POST['sigladisciplina'][$i], $_POST['descricao'][$i]);
                                }*/

                                $cc->Incluir($idmatriz, strtoupper($_POST['siglacurso']), utf8_decode(strtoupper($_POST['sigladisciplina'][$i])), utf8_decode(strtoupper($_POST['descricao'][$i])),$_POST['creditos'][$i], $_POST['ch'][$i], $_POST['periodo'][$i], $_POST['idtipocomponente'][$i]);
                                $matriz->consultar("COMMIT");
                            }
                        }

                        $util->Msgbox('REGISTRO SALVO COM SUCESSO!');
                        $util->redirecionamentopage('default.php?pg=view/matrizcurricular/consulta.php&form=Consulta de Matriz Curricular');
                    } catch (Exception $ex) {
                        $matriz->consultar("ROLLBACK");
                        $util->msgbox("Falha de operacao");
                    }
                
            }
            break;
    }
}

?>