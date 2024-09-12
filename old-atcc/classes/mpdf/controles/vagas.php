<?php

session_start();
require_once('classes/vagas.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../../index.php');

function Processo($Processo) {

    /* Atributos Globais */
    $util = new Util();
    $vagas = new Vagas();

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
            global $linha4;
            global $rs4;

            $vagas->consultar("select * from eventos order by descricao");
            $linha = $vagas->Linha;
            $rs = $vagas->Result;

            $vagas->consultar("select * from unidade_escolar where idunidade_escolar <>137 order by descricao");
            $linha2 = $vagas->Linha;
            $rs2 = $vagas->Result;

            $vagas->consultar("select * from segmentoescolar order by descricao");
            $linha3 = $vagas->Linha;
            $rs3 = $vagas->Result;

            $vagas->consultar("select * from tiposegmento order by descricao");
            $linha4 = $vagas->Linha;
            $rs4 = $vagas->Result;

            if ($_POST['ok'] == 'true') {

                try {
                    foreach ($_POST['idunidade_escolar'] as $i => $v) {
                        $vagas->verificar($_POST['ideventos'], $_POST['idunidade_escolar'][$i], $_POST['idsegmento_escolar'][$i], $_POST['idturno'][$i], $_POST['tipovaga'][$i]);

                        if ($vagas->Achou == 'nao') {
                            $vagas->consultar("BEGIN");
                            $vagas->incluir($_POST['ideventos'], $_POST['idunidade_escolar'][$i], $_POST['idsegmento_escolar'][$i], $_POST['tipovaga'][$i], $_POST['idturno'][$i], $_POST['totalvagas'][$i]);
                            $vagas->consultar("COMMIT");
                        }
                    }
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode("view/vagas/consulta.php") . '&form=' . base64_encode("Consulta de Vagas de Unidades"));
                } catch (Exception $ex) {
                    $vagas->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }



            break;

        case 'editar':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $linha4;
            global $rs4;

            $vagas->consultar("select * from eventos order by descricao");
            $linha = $vagas->Linha;
            $rs = $vagas->Result;

            $vagas->consultar("select ue.idunidade_escolar,ue.descricao, v.totalvagas from unidade_escolar ue inner join vagas v on(ue.idunidade_escolar = v.idunidade_escolar) 
GROUP by ue.descricao order by ue.descricao;");
            $linha2 = $vagas->Linha;
            $rs2 = $vagas->Result;

            if ($_POST['acao'] == 'true') {

                $vagas->consultar("select v.idsegmento_escolar,ue.descricao, se.descricao, ts.descricao,t.descricao,v.totalvagas from vagas v inner join unidade_escolar ue on(v.idunidade_escolar = ue.idunidade_escolar) inner join eventos e on(v.ideventos = e.ideventos) 
inner join segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) inner join turno t on(v.idturno = t.idturno) 
inner join tiposegmento ts on(se.idtipo_segmento= ts.idtipo_segmento)
where se.idtipo_segmento=" . $_POST['idtipo_segmento'] . " and v.ideventos=" . $_POST['ideventos'] . " and v.idturno=" . $_POST['idturno'] . " and v.idunidade_escolar=" . $_POST['idunidade_escolar'] . " and v.tipovaga='" . $_POST['tipovaga'] . "';");
                $linha3 = $vagas->Linha;
                $rs3 = $vagas->Result;
            }

            $vagas->consultar("select * from tiposegmento order by descricao");
            $linha4 = $vagas->Linha;
            $rs4 = $vagas->Result;

            if ($_POST['ok'] == 'true') {
                if ($linha3 > 0) {

                    try {
                        for ($i = 0; $i < $linha3; $i++) {
                            $vagas->consultar("BEGIN");
                            $vagas->alterar($_POST['ideventos'], $_POST['idunidade_escolar'], $_POST['idsegmento_escolar' . $i], $_POST['tipovaga'], $_POST['totalvagas' . $i]);
                            $vagas->consultar("COMMIT");
                        }

                        $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                        $util->redirecionamentopage('default.php?pg=' . base64_encode("view/vagas/editar.php") . '&form=' . base64_encode("Consulta/Atualização de Vagas de Unidades"));
                    } catch (Exception $ex) {
                        $vagas->consultar("ROLLBACK");
                        $util->msgbox("Falha de operacao");
                    }
                }
            }



            break;

        case 'atualizaVagas':
            global $linha;
            global $rs;


            $vagas->consultar("select v.ideventos,v.tipovaga,v.idunidade_escolar,v.idsegmento_escolar,t.descricao,ue.descricao, se.descricao, ts.descricao,t.descricao,v.totalvagas,v.remanescente as Disponivel
,count(i.idinscricao) as TotalInscritos, if(v.totalvagas=count(i.idinscricao),'PREENCHEU', if(v.totalvagas>count(i.idinscricao),'SOBROU VAGA','EXCESSO DE INSCRITOS')) AS situacao  from
inscricao i RIGHT join vagas v on(v.idsegmento_escolar = i.idsegmento_escolar and v.idunidade_escolar = i.idunidade_escolar)
     inner join unidade_escolar ue on(v.idunidade_escolar = ue.idunidade_escolar) inner join eventos e on(v.ideventos = e.ideventos)
     inner join segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) inner join turno t on(v.idturno = t.idturno)
     inner join tiposegmento ts on(se.idtipo_segmento= ts.idtipo_segmento) where i.fase='SEGUNDA'
     AND v.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and i.idsegmento_escolar in(2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19) 
     group by ue.descricao, t.descricao,se.descricao ORDER BY ue.descricao, t.descricao,se.descricao;");
            $linha = $vagas->Linha;
            $rs = $vagas->Result;


            if ($_POST['ok'] == 'true') {
                if ($linha > 0) {

                    try {
                        for ($i = 0; $i < $linha; $i++) {

                            $ideventos = mysql_result($rs, $i, 'v.ideventos');
                            $idunidade_escolar = mysql_result($rs, $i, 'v.idunidade_escolar');
                            $idsegmento_escolar = mysql_result($rs, $i, 'v.idsegmento_escolar');
                            $tipovaga = mysql_result($rs, $i, 'v.tipovaga');
                            $totalvagas = mysql_result($rs, $i, 'v.totalvagas');
                            $vagas->consultar("BEGIN");
                            $vagas->alterar($ideventos, $idunidade_escolar, $idsegmento_escolar, $tipovaga, $totalvagas);
                            $vagas->consultar("COMMIT");
                        }

                        $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                        $util->redirecionamentopage('default.php?pg=' . base64_encode("view/vagas/atualizarVagas.php") . '&form=' . base64_encode("Atualização de Vagas de Unidades"));
                    } catch (Exception $ex) {
                        $vagas->consultar("ROLLBACK");
                        $util->msgbox("Falha de operacao");
                    }
                }
            }

            break;
    }
}

?>