<?php

//quadroVagasEtapa2
@session_start();

function Processo($Processo) {
    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'fichaCandidato':
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');
            $candidatos = new Candidatos();

            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;
            global $tipo;
            global $msg;
            global $unidadeEscolar;
            global $idsegmento_escolar;
            global $situacao;

            $candidatos->consultar("select *, date_format(nascimento, '%d/%m/%Y') as dtnasc,  date_format(i.dtreg, '%d/%m/%Y %H:%i:%s') as dtinscricao from candidatos c inner join inscricao i ON(c.idcandidatos = i.idcandidatos) 
 inner join usuarios u ON(i.idusuarios = u.idusuarios) inner join rendafamiliar rf on(c.idrendafamiliar =rf.idrendafamiliar) 
 inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
 inner join tipoinscricao ti ON(i.idtipoinscricao = ti.idtipoinscricao) 
 inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento) 
 inner join unidade_escolar ue on(ue.idunidade_escolar = u.idunidade_escolar) where i.idcandidatos=" . $_GET['id']);
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;

            $idsegmento_escolar = @mysql_result($rs, 0, 'i.idsegmento_escolar');
            $idunidade_escolar = @mysql_result($rs, 0, 'i.idunidade_escolar');

            $candidatos->consultar("select * from vagas where idsegmento_escolar=" . $idsegmento_escolar . " and idunidade_escolar=" . $idunidade_escolar);
            $linhaAlfa = $candidatos->Linha;
            $rsAlfa = $candidatos->Result;
            $totalVaga = @mysql_result($rsAlfa, 0, 'totalvagas_original_1_fase');
            $totalVaga2 = @mysql_result($rsAlfa, 0, 'totalvagas');

            if (@mysql_result($rs, 0, 'i.classificacao') > $totalVaga && @mysql_result($rs, 0, 'i.classificacao') > 0) {
                $situacao = "AGUARDANDO VAGA";
            }
            if (@mysql_result($rs, 0, 'i.classificacao') > 0 && @mysql_result($rs, 0, 'i.classificacao') <= $totalVaga && @mysql_result($rs, 0, 'i.fase') == 'PRIMEIRA') {
                $situacao = "CLASSIFICADO";
            }

            if (@mysql_result($rs, 0, 'i.classificacao') > $totalVaga2 && @mysql_result($rs, 0, 'i.classificacao') > 0) {
                $situacao = "AGUARDANDO VAGA";
            }
            if (@mysql_result($rs, 0, 'i.classificacao') > 0 && @mysql_result($rs, 0, 'i.classificacao') <= $totalVaga2 && @mysql_result($rs, 0, 'i.fase') == 'SEGUNDA') {
                $situacao = "CLASSIFICADO";
            }
            //$idtipo_segmento=@mysql_result($rs,0,'se.idtipo_segmento');
            $idsegmento_escolar = @mysql_result($rs, 0, 'i.idsegmento_escolar');

            if (@mysql_result($rs, 0, 'i.idtipoinscricao') == 1) {
                $tipo = utf8_decode("FICHA PR&Eacute;-INSCRI&Ccedil;&Atilde;O DE MATR&Iacute;CULA");
            } else {
                $tipo = utf8_decode("FICHA INSCRI&Ccedil;&Atilde;O DE TRANSFER&Ecirc;NCIA");
            }
            $idunidade_escolar = @mysql_result($rs, 0, 'i.idunidade_escolar');
            $candidatos->consultar("select * from unidade_escolar where idunidade_escolar=" . $idunidade_escolar);
            $linha9 = $candidatos->Linha;
            $rs9 = $candidatos->Result;

            $unidadeEscolar = @mysql_result($rs9, 0, 'descricao');
            break;

        case 'consultaQuantitativoCandidato':

            require_once('classes/util.php');
            require_once('classes/candidatos.php');
            $candidatos = new Candidatos();

            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;
            global $tipo;
            global $msg;
            global $unidadeEscolar;
            global $idsegmento_escolar;
            global $linha2;
            global $rs2;
            global $linha4;
            global $rs4;

            $candidatos->consultar("select * from tiposegmento");
            $linha2 = $candidatos->Linha;
            $rs2 = $candidatos->Result;

            $candidatos->consultar("select * from unidade_escolar where idunidade_escolar <>137 order by descricao");
            $linha4 = $candidatos->Linha;
            $rs4 = $candidatos->Result;

            if ($_POST['ok'] == "true") {
                $dtini = $util->formatoDataYMD($_POST['dtini']);
                $dtfim = $util->formatoDataYMD($_POST['dtfim']);

                $candidatos->consultar("Select inscricao.idinscricao,
  candidatos.nome,
  unidade_escolar.descricao,
  tiposegmento.descricao As descricao1,
  segmentoescolar.descricao As descricao2
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito 
WHERE inscricao.idsegmento_escolar='" . $_POST['idsegmento_escolar'] . "' and inscricao.dtreg>='" . $dtini . "' and inscricao.dtreg<='" . $dtfim . "'
GROUP by inscricao.idinscricao order by distrito.descricao,unidade_escolar.descricao,inscricao.idinscricao, candidatos.nome, candidatos.idade");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;


                if ($linha > 0) {
                    echo "<script>window.open('view/relatorios/ListaCandidato.php?dtini=" . $dtini . "&dtfim=" . $dtfim . "&idsegmento_escolar=" . $_POST['idsegmento_escolar'] . "');</script>";

                    echo "<script>window.open('view/relatorios/ListaCandidatoSorteio.php?dtini=" . $dtini . "&dtfim=" . $dtfim . "&idsegmento_escolar=" . $_POST['idsegmento_escolar'] . "');</script>";
                    echo "<script>window.open('view/relatorios/ListaCandidatoSorteioAssinatura.php?dtini=" . $dtini . "&dtfim=" . $dtfim . "&idsegmento_escolar=" . $_POST['idsegmento_escolar'] . "');</script>";
                }
            }


            break;

        case 'listaCandidatoSorteio':
            ini_set('memory_limit', '500M');
            ini_set('max_execution_time', 600);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;
            global $tipo;
            global $msg;
            global $unidadeEscolar;
            global $idsegmento_escolar;

            $dtini = $_GET['dtini'];
            $dtfim = $_GET['dtfim'];

            $candidatos->consultar("Select inscricao.idinscricao,
  candidatos.nome,candidatos.idade,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar='" . $_GET['idsegmento_escolar'] . "' and inscricao.dtreg>='" . $dtini . "' and inscricao.dtreg<='" . $dtfim . "'
GROUP by inscricao.idinscricao order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,inscricao.idinscricao, candidatos.nome, candidatos.idade");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;


        case 'consultaQuantitativoCandidatoCreche':

            require_once('classes/util.php');
            require_once('classes/candidatos.php');
            $candidatos = new Candidatos();
            require_once('classes/util.php');
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;
            global $tipo;
            global $msg;
            global $unidadeEscolar;
            global $idsegmento_escolar;
            global $linha2;
            global $rs2;
            global $linha4;
            global $rs4;

            $candidatos->consultar("select * from tiposegmento");
            $linha2 = $candidatos->Linha;
            $rs2 = $candidatos->Result;

            $candidatos->consultar("select * from unidade_escolar where idunidade_escolar <>137 order by descricao");
            $linha4 = $candidatos->Linha;
            $rs4 = $candidatos->Result;

            if ($_POST['ok'] == "true") {
                $dtini = $util->formatoDataYMD($_POST['dtini']);
                $dtfim = $util->formatoDataYMD($_POST['dtfim']);
                $idsegmento_escolar = 15;
                $idunidade_escolar = 14;
                $dtini = '2014-01-01';
                $dtfim = '2014-12-30';

                $candidatos->consultar("Select inscricao.idinscricao,
  candidatos.nome,
  unidade_escolar.descricao,
  tiposegmento.descricao As descricao1,
  segmentoescolar.descricao As descricao2
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito 
WHERE inscricao.idsegmento_escolar='" . $idsegmento_escolar . "' and inscricao.idunidade_escolar='" . $idunidade_escolar . "' and inscricao.dtreg>='" . $dtini . "' and inscricao.dtreg<='" . $dtfim . "'
GROUP by inscricao.idinscricao order by distrito.descricao,unidade_escolar.descricao,inscricao.idinscricao, candidatos.nome, candidatos.idade");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;


                if ($linha > 0) {

                    echo "<script>window.open('view/relatorios/ListaCandidatoSorteioCreche.php?dtini=" . $dtini . "&dtfim=" . $dtfim . "&idsegmento_escolar=" . $idsegmento_escolar . "&idunidade_escolar=" . $idunidade_escolar . "');</script>";
                    echo "<script>window.open('view/relatorios/ListaCandidatoSorteioAssinaturaCreche.php?dtini=" . $dtini . "&dtfim=" . $dtfim . "&idsegmento_escolar=" . $idsegmento_escolar . "&idunidade_escolar=" . $idunidade_escolar . "');</script>";
                    /* echo "<script>window.open('view/relatorios/ListaCandidatoSorteioCreche.php?dtini=" . $dtini . "&dtfim=" . $dtfim . "&idsegmento_escolar=" . $_POST['idsegmento_escolar'] . "&idunidade_escolar=" . $_POST['idunidade_escolar'] . "');</script>";
                      echo "<script>window.open('view/relatorios/ListaCandidatoSorteioAssinaturaCreche.php?dtini=" . $dtini . "&dtfim=" . $dtfim . "&idsegmento_escolar=" . $_POST['idsegmento_escolar'] . "&idunidade_escolar=" . $_POST['idunidade_escolar'] . "');</script>"; */
                }
            }


            break;

        case 'listaCandidatoSorteioCreche':
            ini_set('memory_limit', '999M');
            ini_set('max_execution_time', 3000);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;
            global $array;
            global $msg;
            global $unidadeEscolar;
            global $idsegmento_escolar;
            global $cont;

            $dtini = $_GET['dtini'];
            $dtfim = $_GET['dtfim'];

            $candidatos->consultar("select i.idunidade_escolar,ue.descricao, se.idsegmento_escolar,se.descricao, i.idinscricao, c.nome, d.descricao, ts.descricao from candidatos c 
  inner join inscricao i on(c.idcandidatos = i.idcandidatos) 
  inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar) 
  inner join segmentoescolar se on(i.idsegmento_escolar=se.idsegmento_escolar) 
  inner join distrito d on(ue.iddistrito = d.iddistrito) 
  inner join tiposegmento ts on(se.idtipo_segmento = ts.idtipo_segmento)
  where i.idsegmento_escolar >= 15  and i.idsegmento_escolar <=21 and (i.idunidade_escolar<>66 and i.idunidade_escolar<>164 
  and i.idunidade_escolar<>1 and i.idunidade_escolar<>2 and i.idunidade_escolar<>67 and i.idunidade_escolar<>125 and i.idunidade_escolar<>180)
  group by d.descricao,i.idinscricao order by d.descricao,se.descricao,ue.descricao,i.idinscricao,c.nome;");
            $linha = $candidatos->Linha; //and i.idsegmento_escolar <=21
            $rs = $candidatos->Result;


//$array[0]['flag'] = 1;
            $idunidade_escolar = "";
            $array[0]['uni'] = mysql_result($rs, 0, 'i.idunidade_escolar');
            $array[0]['seg'] = mysql_result($rs, 0, 'se.idsegmento_escolar');
            $cont = 0;
            for ($i = 0; $i < $linha; $i++) {
                if ($idunidade_escolar != mysql_result($rs, $i, 'i.idunidade_escolar')) {

                    $array[$i]['flag'] = 1;
                } else {


                    $array[$i]['flag'] = 0;
                }
                $array[$i]['idunidade_escolar'] = mysql_result($rs, $i, 'i.idunidade_escolar');
                $idunidade_escolar = mysql_result($rs, $i, 'i.idunidade_escolar');

                $array[$i]['unidade'] = mysql_result($rs, $i, 'ue.descricao');
                $array[$i]['tipo_segmento'] = mysql_result($rs, $i, 'ts.descricao');
                $array[$i]['segmento'] = mysql_result($rs, $i, 'se.descricao');
                $array[$i]['distrito'] = mysql_result($rs, $i, 'd.descricao');
                $array[$i]['protocolo'] = "000" . mysql_result($rs, $i, 'i.idinscricao');
                $array[$i]['nome'] = mysql_result($rs, $i, 'c.nome');

                if ($array[$i]['uni'] == mysql_result($rs, $i, 'i.idunidade_escolar') && $array[$i]['seg'] == mysql_result($rs, $i, 'se.idsegmento_escolar')) {
                    $cont++;
                    $array[$i]['uni'] = mysql_result($rs, $i, 'i.idunidade_escolar');
                    $array[$i]['seg'] = mysql_result($rs, $i, 'se.idsegmento_escolar');
                } else {
                    $array[$i]['total'] = $cont;
                }
            }

            //print_r($array);exit;
            if ($linha > 0) {
                /* echo "<script>window.open('view/relatorios/ListaCandidatoSorteioAssinatura.php');</script>";
                  //echo "<script>window.open('view/relatorios/ListaCandidatoSorteio.php?dtini=" . $dtini . "&dtfim=" . $dtfim . "&idsegmento_escolar=" . $_POST['idsegmento_escolar'] . "');</script>";
                  //echo "<script>window.open('view/relatorios/ListaCandidatoSorteioAssinatura.php?dtini=" . $dtini . "&dtfim=" . $dtfim . "&idsegmento_escolar=" . $_POST['idsegmento_escolar'] . "');</script>"; */
            }

            break;

        case 'relQuantitativoCandidatoDistritoPrematricula':
            ini_set('memory_limit', '500M');
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');
            $candidatos = new Candidatos();

            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;

            $candidatos->consultar("select d.descricao, COUNT(*) as total from candidatos c inner join inscricao i on(i.idcandidatos = c.idcandidatos) 
inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar) inner join distrito d 
on(ue.iddistrito = d.iddistrito) where i.idtipoinscricao=1 GROUP BY d.iddistrito order by d.descricao;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;

        case 'relQuantitativoCandidatoDistritoTransferencia':
            ini_set('memory_limit', '500M');
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');
            $candidatos = new Candidatos();

            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;

            $candidatos->consultar("select d.descricao, COUNT(*) as total from candidatos c inner join inscricao i on(i.idcandidatos = c.idcandidatos) 
inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar) inner join distrito d 
on(ue.iddistrito = d.iddistrito) where i.idtipoinscricao=2 GROUP BY d.iddistrito order by d.descricao;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;

            break;

        case 'relQuantitativoCandidatoUE':
            ini_set('memory_limit', '500M');
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');
            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;

            $candidatos->consultar("select ue.descricao, COUNT(*) as total from candidatos c inner join inscricao i on(i.idcandidatos = c.idcandidatos) 
inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar) inner join distrito d 
on(ue.iddistrito = d.iddistrito) GROUP BY ue.idunidade_escolar order by ue.descricao;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;

        case 'relQuantitativoCandidatoSE':
            ini_set('memory_limit', '500M');
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');
            $candidatos = new Candidatos();

            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;

            $candidatos->consultar("select ts.descricao,ue.descricao, se.descricao,COUNT(*) as total from candidatos c inner join inscricao i on(i.idcandidatos = c.idcandidatos) 
inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar) inner join distrito d 
on(ue.iddistrito = d.iddistrito) inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
inner join tiposegmento ts on(se.idtipo_segmento=ts.idtipo_segmento)
GROUP BY ts.idtipo_segmento,ue.idunidade_escolar, se.idsegmento_escolar order by se.descricao;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;

        case 'relduplicacao':
            ini_set('memory_limit', '500M');
            ini_set('max_execution_time', 600);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;


            $candidatos->consultar("SELECT DISTINCT c.idcandidatos,i.idinscricao, c.cpf, c.nome, ue.descricao FROM candidatos c inner join inscricao i on(i.idcandidatos = c.idcandidatos) 
inner join unidade_escolar ue ON(i.idunidade_escolar = ue.idunidade_escolar)
inner join usuarios u on(i.idusuarios=u.idusuarios) GROUP by c.nome HAVING count(c.nome) > 1 order by c.nome;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;

            break;

        case 'relinscricaoindevida':
            ini_set('memory_limit', '500M');
            ini_set('max_execution_time', 600);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;


            $candidatos->consultar("select  i.idunidade_escolar,ue.descricao, se.descricao,count(*) as total from inscricao i inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar) 
   INNER join segmentoescolar se ON(i.idsegmento_escolar= se.idsegmento_escolar) inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento)
 where i.idunidade_escolar not in(select v.idunidade_escolar from vagas v) and i.idunidade_escolar not in(select v.idsegmento_escolar from vagas v)
 and ts.idtipo_segmento =4 group by i.idunidade_escolar,i.idsegmento_escolar order by ue.descricao");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;

        case 'quadroVagas':
            ini_set('memory_limit', '500M');
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');
            $candidatos = new Candidatos();

            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;


            /* $candidatos->consultar("select v.idturno,v.idsegmento_escolar,ts.idtipo_segmento,ue.idunidade_escolar,t.descricao,ue.descricao, se.descricao, ts.descricao,t.descricao,v.totalvagas from vagas v 
              inner join unidade_escolar ue on(v.idunidade_escolar = ue.idunidade_escolar) inner join eventos e on(v.ideventos = e.ideventos)
              inner join segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) inner join turno t on(v.idturno = t.idturno)
              inner join tiposegmento ts on(se.idtipo_segmento= ts.idtipo_segmento) where v.tipovaga='INSCRICAO' ORDER BY ue.descricao, t.descricao,se.descricao;"); */

            $candidatos->consultar("select v.idturno,v.idsegmento_escolar,ts.idtipo_segmento,ue.idunidade_escolar,t.descricao,ue.descricao, se.descricao, ts.descricao,t.descricao,v.totalvagas 
,count(i.idinscricao) as TotalInscritos, if(v.totalvagas=count(i.idinscricao),'PREENCHEU', if(v.totalvagas>count(i.idinscricao),'SOBROU VAGA','EXCESSO DE INSCRITOS')) AS situacao  from 
inscricao i RIGHT join vagas v on(v.idsegmento_escolar = i.idsegmento_escolar and v.idunidade_escolar = i.idunidade_escolar)
     inner join unidade_escolar ue on(v.idunidade_escolar = ue.idunidade_escolar) inner join eventos e on(v.ideventos = e.ideventos) 
     inner join segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) inner join turno t on(v.idturno = t.idturno) 
     inner join tiposegmento ts on(se.idtipo_segmento= ts.idtipo_segmento) where v.tipovaga='INSCRICAO' 
     AND v.idunidade_escolar NOT IN(66,164,1,2,67,125,180) 
     group by ue.descricao, t.descricao,se.descricao ORDER BY ue.descricao, t.descricao,se.descricao");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;
            $idunidade_escolar = 0;
            $idtipo_segmento = 0;
            $idturno = 0;
            $arr = array();


            break;

        case 'quadroVagasTransferencia':
            ini_set('memory_limit', '500M');
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');
            $candidatos = new Candidatos();

            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;


            /* $candidatos->consultar("select v.idturno,v.idsegmento_escolar,ts.idtipo_segmento,ue.idunidade_escolar,t.descricao,ue.descricao, se.descricao, ts.descricao,t.descricao,v.totalvagas from vagas v 
              inner join unidade_escolar ue on(v.idunidade_escolar = ue.idunidade_escolar) inner join eventos e on(v.ideventos = e.ideventos)
              inner join segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) inner join turno t on(v.idturno = t.idturno)
              inner join tiposegmento ts on(se.idtipo_segmento= ts.idtipo_segmento) where v.tipovaga='TRANSFERENCIA' ORDER BY ue.descricao, t.descricao,se.descricao;");
             */

            $candidatos->consultar("select v.idturno,v.idsegmento_escolar,ts.idtipo_segmento,ue.idunidade_escolar,t.descricao,ue.descricao, se.descricao, ts.descricao,t.descricao,v.totalvagas 
,count(i.idinscricao) as TotalInscritos, if(v.totalvagas=count(i.idinscricao),'PREENCHEU', if(v.totalvagas>count(i.idinscricao),'SOBROU VAGA','EXCESSO DE INSCRITOS')) AS situacao  from 
inscricao i RIGHT join vagas v on(v.idsegmento_escolar = i.idsegmento_escolar and v.idunidade_escolar = i.idunidade_escolar)
     inner join unidade_escolar ue on(v.idunidade_escolar = ue.idunidade_escolar) inner join eventos e on(v.ideventos = e.ideventos) 
     inner join segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) inner join turno t on(v.idturno = t.idturno) 
     inner join tiposegmento ts on(se.idtipo_segmento= ts.idtipo_segmento) where v.tipovaga='TRANSFERENCIA' 
     AND v.idunidade_escolar NOT IN(66,164,1,2,67,125,180) 
     group by ue.descricao, t.descricao,se.descricao ORDER BY ue.descricao, t.descricao,se.descricao");

            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;
            $idunidade_escolar = 0;
            $idtipo_segmento = 0;
            $idturno = 0;
            $arr = array();



            break;

        case 'cartaInscricaoIndevida':
            ini_set('memory_limit', '999M');
            ini_set('max_execution_time', 2000);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;

            $candidatos->consultar("select * from teste t 
inner join unidade_escolar ue on(t.idunidadeSugestao = ue.idunidade_escolar) 
inner join segmentoescolar se on(t.idsegmento_escolar = se.idsegmento_escolar) 
inner join inscricao i on(t.idinscricao=i.idinscricao) 
inner join candidatos c on(i.idcandidatos = c.idcandidatos)
where t.idunidadeSugestao=14
order by ue.descricao, se.descricao,c.nome;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;

        case 'cartaEdInfantil':
            ini_set('memory_limit', '999M');
            ini_set('max_execution_time', 2000);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;

            $candidatos->consultar("select * from candidatos c 
  inner join inscricao i on(c.idcandidatos = i.idcandidatos) 
  inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar) 
  inner join segmentoescolar se on(i.idsegmento_escolar=se.idsegmento_escolar) 
  inner join distrito d on(ue.iddistrito = d.iddistrito) 
  inner join tiposegmento ts on(se.idtipo_segmento = ts.idtipo_segmento)
  where i.idsegmento_escolar >= 15  and i.idsegmento_escolar <=21 and i.idinscricao=31
  group by d.descricao,i.idinscricao order by d.descricao,se.descricao,ue.descricao,i.idinscricao,c.nome;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;

        case 'cartaEdFundamental':
            ini_set('memory_limit', '999M');
            ini_set('max_execution_time', 2000);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;

            /* $candidatos->consultar("select * from inscricao i inner join candidatos c on(i.idcandidatos = c.idcandidatos) 
              inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar)
              inner join segmentoescolar se on(i.idsegmento_escolar=se.idsegmento_escolar)
              inner join distrito d on(ue.iddistrito = d.iddistrito)
              inner join tiposegmento ts on(se.idtipo_segmento = ts.idtipo_segmento)
              inner join vagas v on(i.idunidade_escolar = v.idunidade_escolar and i.idsegmento_escolar = v.idsegmento_escolar)
              WHERE i.idsegmento_escolar=6 and i.classificacao <= v.totalvagas group by i.idinscricao
              order by ue.iddistrito, ue.descricao, i.classificacao,c.nascimento, i.dtreg;"); */

            /* $candidatos->consultar("select * from inscricao i inner join candidatos c on(i.idcandidatos = c.idcandidatos) 
              inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar)
              inner join segmentoescolar se on(i.idsegmento_escolar=se.idsegmento_escolar)
              inner join distrito d on(ue.iddistrito = d.iddistrito)
              inner join tiposegmento ts on(se.idtipo_segmento = ts.idtipo_segmento)
              inner join vagas v on(i.idunidade_escolar = v.idunidade_escolar and i.idsegmento_escolar = v.idsegmento_escolar)
              WHERE i.idsegmento_escolar=6 and i.idunidade_escolar=103 and i.idinscricao in(select idinscricao from distribuicaofundamental)
              group by i.idinscricao
              order by ue.iddistrito, ue.descricao, i.classificacao,c.nascimento, i.dtreg;"); */

            $candidatos->consultar("select *
 from inscricao i inner join candidatos c on(i.idcandidatos = c.idcandidatos)
 inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar)
 inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar)
 where i.idunidade_escolar=138 and i.idsegmento_escolar=6 order by i.classificacao limit 11,23");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;

        case 'cartaEja':
            ini_set('memory_limit', '999M');
            ini_set('max_execution_time', 2000);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;

            $candidatos->consultar("select * from inscricao i inner join candidatos c on(i.idcandidatos = c.idcandidatos) 
inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar) 
inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar)
where i.idsegmento_escolar=1 order by ue.descricao, c.nascimento, i.dtreg;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;

        case 'quadroVagasEtapa2':
            ini_set('memory_limit', '500M');
            ini_set('max_execution_time', 600);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;
            global $tipo;
            global $msg;
            global $unidadeEscolar;
            global $idsegmento_escolar;

            $dtini = $_GET['dtini'];
            $dtfim = $_GET['dtfim'];

            $candidatos->consultar("select *,count(i.idinscricao) as TotalInscritos, if(v.totalvagas=count(i.idinscricao),'PREENCHEU', if(v.totalvagas>count(i.idinscricao),'SOBROU VAGA','EXCESSO DE INSCRITOS')) AS situacao  from
inscricao i inner join vagas v on(v.idsegmento_escolar = i.idsegmento_escolar and v.idunidade_escolar = i.idunidade_escolar)
     inner join unidade_escolar ue on(v.idunidade_escolar = ue.idunidade_escolar) inner join eventos e on(v.ideventos = e.ideventos)
     inner join segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) inner join turno t on(v.idturno = t.idturno)
     inner join tiposegmento ts on(se.idtipo_segmento= ts.idtipo_segmento) inner join distrito d on(ue.iddistrito = d.iddistrito)
     where i.fase='SEGUNDA'
     AND v.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and i.idsegmento_escolar in(2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19) 
     group by ue.descricao, t.descricao,se.descricao ORDER BY d.descricao,ue.descricao, t.descricao,se.descricao;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;


            break;

        case 'quadroVagasEtapa2ComInscritos':
            ini_set('memory_limit', '900M');
            ini_set('max_execution_time', 9000);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;
            global $tipo;
            global $msg;
            global $unidadeEscolar;
            global $idsegmento_escolar;

            $dtini = $_GET['dtini'];
            $dtfim = $_GET['dtfim'];

            $candidatos->consultar("select *,count(i.idinscricao) as TotalInscritos, if(v.totalvagas=count(i.idinscricao),'PREENCHEU', if(v.totalvagas>count(i.idinscricao),'SOBROU VAGA','EXCESSO DE INSCRITOS')) AS situacao  from
inscricao i inner join vagas v on(v.idsegmento_escolar = i.idsegmento_escolar and v.idunidade_escolar = i.idunidade_escolar)
     inner join unidade_escolar ue on(v.idunidade_escolar = ue.idunidade_escolar) inner join eventos e on(v.ideventos = e.ideventos)
     inner join segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) inner join turno t on(v.idturno = t.idturno)
     inner join tiposegmento ts on(se.idtipo_segmento= ts.idtipo_segmento) inner join distrito d on(ue.iddistrito = d.iddistrito)
     where v.tipovaga='INSCRICAO' and i.fase='SEGUNDA'
     AND v.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and i.idsegmento_escolar in(2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19) 
     group by ue.descricao, t.descricao,se.descricao ORDER BY ue.descricao, t.descricao,se.descricao");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;

            break;

        case 'listaEtapa':
            ini_set('memory_limit', '500M');
            ini_set('max_execution_time', 600);
            require_once('../../classes/util.php');
            require_once('../../classes/candidatos.php');

            $candidatos = new Candidatos();
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], '../index.php');
            global $linha;
            global $rs;
            global $tipo;
            global $unidade;
            global $totalVagas;
            $candidatos->consultar("select * from vagas 
where idunidade_escolar=" . $_GET['idunidade'] . " and idsegmento_escolar=" . $_GET['idsegmento']);
            $linha2 = $candidatos->Linha;
            $rs2 = $candidatos->Result;

            if ($_GET['fase'] == 'PRIMEIRA') {
                $totalVagas = @mysql_result($rs2, 0, 'totalvagas_original_1_fase');
            }
            if ($_GET['fase'] == 'SEGUNDA') {
                $totalVagas = @mysql_result($rs2, 0, 'totalvagas');
            }

            if ($_GET['idtipo_inscricao'] == 1) {
                $tipo = 'PR&Eacute;-INSCRI&Ccedil;&Otilde;ES';
            }
            if ($_GET['idtipo_inscricao'] == 2) {
                $tipo = 'TRANSFER&Ecirc;NCIAS';
            }

//--------------------------------para a pr&eacute;-matricula Primeira fase------------------
            if ($_GET['fase'] == 'PRIMEIRA' && $_GET['educacao'] == 'INFANTIL' && $_GET['idtipo_inscricao'] == 1) {

                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='PRIMEIRA'
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }
            if ($_GET['fase'] == 'PRIMEIRA' && $_GET['educacao'] == 'FUNDAMENTAL' && $_GET['idtipo_inscricao'] == 1) {
                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='PRIMEIRA'
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }
            if ($_GET['fase'] == 'PRIMEIRA' && $_GET['educacao'] == 'EJA' && $_GET['idtipo_inscricao'] == 1) {
                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='PRIMEIRA'
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }
            //--------------------------------para a Transfer&ecirc;ncia------------------

            if ($_GET['fase'] == 'PRIMEIRA' && $_GET['educacao'] == 'FUNDAMENTAL' && $_GET['idtipo_inscricao'] == 2) {
                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='PRIMEIRA'
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }
            if ($_GET['fase'] == 'PRIMEIRA' && $_GET['educacao'] == 'EJA' && $_GET['idtipo_inscricao'] == 2) {
                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='PRIMEIRA'
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }

//--------------------------------para a pr&eacute;-matricula Segunda fase------------------

            if ($_GET['fase'] == 'PRIMEIRA' && $_GET['educacao'] == 'INFANTIL' && $_GET['idtipo_inscricao'] == 2) {
                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='SEGUNDA' and inscricao.classificacao is not null
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }
            if ($_GET['fase'] == 'SEGUNDA' && $_GET['educacao'] == 'FUNDAMENTAL' && $_GET['idtipo_inscricao'] == 1) {
                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='SEGUNDA'
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }
            if ($_GET['fase'] == 'SEGUNDA' && $_GET['educacao'] == 'EJA' && $_GET['idtipo_inscricao'] == 1) {
                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='SEGUNDA' and inscricao.classificacao is not null
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }
            //--------------------------------para a Transfer&ecirc;ncia------------------

            if ($_GET['fase'] == 'SEGUNDA' && $_GET['educacao'] == 'FUNDAMENTAL' && $_GET['idtipo_inscricao'] == 2) {
                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='SEGUNDA' and inscricao.classificacao is not null
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }
            if ($_GET['fase'] == 'SEGUNDA' && $_GET['educacao'] == 'EJA' && $_GET['idtipo_inscricao'] == 2) {
                $candidatos->consultar("Select inscricao.idinscricao,inscricao.classificacao,
  candidatos.idcandidatos,candidatos.nome,candidatos.endereco,candidatos.bairro,candidatos.telefone,candidatos.celular,
  unidade_escolar.descricao,
  tiposegmento.descricao,
  segmentoescolar.descricao, distrito.descricao
From unidade_escolar
  Inner Join inscricao On unidade_escolar.idunidade_escolar =
    inscricao.idunidade_escolar
  Inner Join segmentoescolar On segmentoescolar.idsegmento_escolar =
    inscricao.idsegmento_escolar
  Inner Join candidatos On candidatos.idcandidatos = inscricao.idcandidatos
  Inner Join tiposegmento On tiposegmento.idtipo_segmento =
    segmentoescolar.idtipo_segmento Inner Join distrito On distrito.iddistrito = unidade_escolar.iddistrito   
WHERE inscricao.idsegmento_escolar=" . $_GET['idsegmento'] . " and inscricao.idunidade_escolar=" . $_GET['idunidade'] . "
and inscricao.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and inscricao.fase='SEGUNDA' and inscricao.classificacao is not null
GROUP by inscricao.idinscricao 
order by distrito.descricao,unidade_escolar.descricao,distrito.descricao,
inscricao.classificacao, candidatos.nome");
                $linha = $candidatos->Linha;
                $rs = $candidatos->Result;
            }
            $unidade = @mysql_result($rs, 0, 'unidade_escolar.descricao');

            break;
    }
}

?>