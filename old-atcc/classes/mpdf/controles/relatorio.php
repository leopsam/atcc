<?php

function Processo($Processo) {

    switch ($Processo) {
        case 'imprimirFicha':
            @session_start();
            ini_set("max_execution_time", 120000);
            require_once('../../classes/relatorios.php');
            require_once('../../classes/util.php');
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $ln;
            global $r;
            global $ln2;
            global $r2;

            $util = new Util();
            $relatorios = new Relatorios();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $relatorios->consultar("select *, DATE_FORMAT(p.nascimento,'%d/%m/%Y') AS dtnasc, DATE_FORMAT(mp.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(mp.data_fim,'%d/%m/%Y') AS termino from pessoas p inner join funcionarios f on(p.idpessoas = f.idpessoas) 
inner join professor prof on(prof.idpessoas = p.idpessoas) 
inner join matriculaprofessor mp on(prof.idpessoas = mp.idpessoas) inner join usuarios u on(p.idusuarios = u.idusuarios) 
inner join titulacao t on(prof.idtitulacao=t.idtitulacao)
where p.idpessoas=" . $_GET['id']);
            $ln = $relatorios->Linha;
            $r = $relatorios->Result;

            $idfuncionarios = @mysql_result($r, 0, 'f.idfuncionarios');

            $relatorios->consultar("select *, DATE_FORMAT(af.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(af.data_termino,'%d/%m/%Y') AS termino from funcionarios f inner join pessoas p 
on(p.idpessoas = f.idpessoas) inner join atividadesfuncionais af on(af.idfuncionarios = f.idfuncionarios) 
inner join funcao on(af.idfuncao=funcao.idfuncao)
where p.idpessoas=" . $_GET['id']);
            $ln2 = $relatorios->Linha;
            $r2 = $relatorios->Result;

            break;

        case 'imprimirFichaAluno':
            @session_start();
            ini_set("max_execution_time", 120000);
            require_once('../../classes/relatorios.php');
            require_once('../../classes/util.php');
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $ln;
            global $r;
            global $ln2;
            global $r2;

            $util = new Util();
            $relatorios = new Relatorios();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $relatorios->consultar("select *, DATE_FORMAT(p.nascimento,'%d/%m/%Y') AS dtnasc, DATE_FORMAT(mp.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(mp.data_fim,'%d/%m/%Y') AS termino from pessoas p inner join funcionarios f on(p.idpessoas = f.idpessoas) 
inner join professor prof on(prof.idpessoas = p.idpessoas) 
inner join matriculaprofessor mp on(prof.idpessoas = mp.idpessoas) inner join usuarios u on(p.idusuarios = u.idusuarios) 
inner join titulacao t on(prof.idtitulacao=t.idtitulacao)
where p.idpessoas=" . $_GET['id']);
            $ln = $relatorios->Linha;
            $r = $relatorios->Result;

            $idfuncionarios = mysql_result($r, 0, 'f.idfuncionarios');

            $relatorios->consultar("select *, DATE_FORMAT(af.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(af.data_termino,'%d/%m/%Y') AS termino from funcionarios f inner join pessoas p 
on(p.idpessoas = f.idpessoas) inner join atividadesfuncionais af on(af.idfuncionarios = f.idfuncionarios) 
inner join funcao on(af.idfuncao=funcao.idfuncao)
where p.idpessoas=" . $_GET['id']);
            $ln2 = $relatorios->Linha;
            $r2 = $relatorios->Result;

            break;

        case 'imprimirRelatorioTurma':
            @session_start();
            ini_set("max_execution_time", 120000);
            require_once('../../classes/turmas.php');

            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;

            $relatorios = new Turma();

            $relatorios->consultar("select * from turma t inner join periodoletivo pl on(t.idperiodoletivo = pl.idperiodoletivo) inner join situacaoturma st 
on(t.idsituacaoturma = st.idsituacaoturma) INNER join turno on(t.idturno=turno.idturno) 
inner join disciplinas d on(t.sigladisciplina=d.sigladisciplina) 
left join matriculaprofessor mp on(t.matriculaprofessor = mp.matriculaprofessor) 
inner join grade_horario gh on(t.idgrade_horario = gh.idgrade_horario) inner join componentecurricular cc on(t.sigladisciplina=cc.sigladisciplina) 
inner join curso c on(t.siglacurso=c.siglacurso)
 where t.siglacurso='" . $_GET['siglacurso'] . "' and t.idperiodoletivo=" . $_GET['idperiodoletivo'] . " and t.idturno=" . $_GET['idturno'] . " and t.idturma=" . $_GET['idturma'] . " order by t.idturma,gh.descricao,turno.descricao, d.descricao, st.descricao");
            $linha3 = $relatorios->Linha;
            $rs3 = $relatorios->Result;


            break;

        case 'imprimirFichaFuncionarios':
            @session_start();
            ini_set("max_execution_time", 120000);
            require_once('../../classes/relatorios.php');
            require_once('../../classes/util.php');
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $ln;
            global $r;
            global $ln2;
            global $r2;

            $util = new Util();
            $relatorios = new Relatorios();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $relatorios->consultar("select *,DATE_FORMAT(p.nascimento,'%d/%m/%Y') AS dtnasc from funcionarios f inner join pessoas p on(f.idpessoas = p.idpessoas) 
inner JOIN usuarios u on(p.idusuarios = u.idusuarios) inner join atividadesfuncionais af 
on(af.idfuncionarios = f.idfuncionarios) inner join funcao fun on(af.idfuncao = fun.idfuncao) 
where p.idpessoas =" . $_GET['id']);
            $ln = $relatorios->Linha;
            $r = $relatorios->Result;

            $idfuncionarios = mysql_result($r, 0, 'f.idfuncionarios');
            break;


        case 'consultarMatriz':
            @session_start();
            ini_set("max_execution_time", 120000);
            require_once('classes/relatorios.php');
            require_once('classes/util.php');
            global $linha;
            global $rs;
            global $linha3;
            global $rs3;


            $util = new Util();
            $relatorios = new Relatorios();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $relatorios->consultar("select * from curso order by siglacurso, descricao");
            $linha = $relatorios->Linha;
            $rs = $relatorios->Result;


            if ($_POST['ok'] == 'true') {

                $relatorios->consultar("select *,DATE_FORMAT(data_vigencia,'%d/%m/%Y') as vigencia from matriz where idmatriz='" . $_POST['idmatriz'] . "' and siglacurso='" . $_POST['siglacurso'] . "' order by data_vigencia desc;");
                $linha3 = $relatorios->Linha;
                $rs3 = $relatorios->Result;
            }


            break;


        case 'gerarMatriz':
            @session_start();
            ini_set("max_execution_time", 120000);
            require_once('../../classes/relatorios.php');
            require_once('../../classes/util.php');
            global $linha;
            global $rs;
            global $linha3;
            global $rs3;


            $util = new Util();
            $relatorios = new Relatorios();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');


            $relatorios->consultar("select *,DATE_FORMAT(m.data_vigencia,'%d/%m/%Y') as vigencia from componentecurricular cc 
inner join tipocomponente tc on(cc.idtipocomponente= tc.idtipocomponente) inner join curso c on(cc.siglacurso=c.siglacurso) inner join matriz m
on(cc.idmatriz=m.idmatriz)
where cc.idmatriz='" . $_GET['idmatriz'] . "' and cc.siglacurso='" . $_GET['siglacurso'] . "' order by cc.periodo, cc.sigladisciplina;");


            $linha3 = $relatorios->Linha;
            $rs3 = $relatorios->Result;



            break;

        case 'gerarCalendarioLetivo':
            @session_start();
            ini_set("max_execution_time", 120000);
            require_once('../../classes/relatorios.php');
            require_once('../../classes/util.php');
            require_once('../../classes/calendarioletivo.php');
            global $linha;
            global $rs;
            global $linha3;
            global $rs3;
            global $SEG;
            global $TER;
            global $QUA;
            global $QUI;
            global $SEX;
            global $SAB;


            $util = new Util();
            $relatorios = new Relatorios();
            $calendarioletivo = new CalendarioLetivo();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $SEG = array();
            $TER = array();
            $QUA = array();
            $QUI = array();
            $SEX = array();
            $SAB = array();
            $FERIADO= array();

            for ($x = 1; $x < 7; $x++) {
                $diasemana = $util->diaSemanaAbreviado($x);
                $relatorios->consultar("select *, DATE_FORMAT(data,'%d/%m') from calendarioletivo where diasemana='" . $diasemana . "' and idperiodoletivo=" . $idperiodoletivo);
                $linha3 = $relatorios->Linha;
                $rs3 = $relatorios->Result;
             for ($i =0; $i <$linha3; $i++) {
                switch ($diasemana) {                    
                    case"1":
                        $SEG[$i]=mysql_result($rs3, $i, 'data');
                        $FERIADO==mysql_result($rs3, $i, 'feriado');
                    break;
                    case"2":
                        $TER[$i]=mysql_result($rs3, $i, 'data');
                        $FERIADO=mysql_result($rs3, $i, 'feriado');
                    break;
                    case"3":
                        $QUA[$i]=mysql_result($rs3, $i, 'data');
                        $FERIADO=mysql_result($rs3, $i, 'feriado');
                    break;
                    case"4":
                        $QUI[$i]=mysql_result($rs3, $i, 'data');
                        $FERIADO=mysql_result($rs3, $i, 'feriado');
                    break;
                    case"5":
                        $SEX[$i]=mysql_result($rs3, $i, 'data');
                        $FERIADO=mysql_result($rs3, $i, 'feriado');
                    break;
                    case"6":
                        $SAB[$i]=mysql_result($rs3, $i, 'data');
                        $FERIADO==mysql_result($rs3, $i, 'feriado');
                    break;
                }
            }//FIM FOR
            }//fim for 
            
            
            break;
    }
}

//fim function
?>