<?php
session_start();

require_once('classes/turmas.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../../index.php');

function Processo($Processo) {

    /* Atributos Globais */
    $util = new Util();
    $turma = new Turma();
    global $linha;
    global $rs;
    global $linha2;
    global $rs2;
    global $linha3;
    global $rs3;
    global $linha4;
    global $rs4;
    global $linha5;
    global $rs5;
    global $linha6;
    global $rs6;
    global $linha7;
    global $rs7;

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':

            $turma->consultar("select * from curso order by siglacurso, descricao");
            $linha = $turma->Linha;
            $rs = $turma->Result;

            $turma->consultar("select * from turno order by descricao");
            $linha2 = $turma->Linha;
            $rs2 = $turma->Result;

            $turma->consultar("select * from disciplinas order by descricao");
            $linha3 = $turma->Linha;
            $rs3 = $turma->Result;

            $turma->consultar("select *, DATE_FORMAT(data_vigencia,'%d/%m/%Y') as vigencia from matriz order by data_vigencia desc");
            $linha4 = $turma->Linha;
            $rs4 = $turma->Result;

            $turma->consultar("select * from situacaoturma order by descricao");
            $linha5 = $turma->Linha;
            $rs5 = $turma->Result;

            $turma->consultar("select * from grade_horario order by descricao");
            $linha6 = $turma->Linha;
            $rs6 = $turma->Result;

            $turma->consultar("select * from pessoas p inner join professor prof on(p.idpessoas = prof.idpessoas) inner join matriculaprofessor mp 
on(prof.idpessoas = mp.idpessoas) order by mp.matriculaprofessor, p.nome");
            $linha7 = $turma->Linha;
            $rs7 = $turma->Result;

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Incluir

                    $turma->consultar("BEGIN");
                    $turma->Incluir($_POST['idturma'], $_POST['siglacurso'], $_POST['sigladisciplina'], $_POST['idmatriz'], $_POST['matriculaprofessor'], $_POST['idgrade_horario'], $_POST['idperiodoletivo'], $_POST['idturno'], $_POST['idsituacaoturma'], $_POST['qtdetotal']);
                    $turma->consultar("COMMIT");

                    $util->Msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/turmas/consulta.php&form=Consulta de Turmas');
                } catch (Exception $ex) {
                    $turma->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
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

            $turma->consultar("select * from curso order by siglacurso, descricao");
            $linha = $turma->Linha;
            $rs = $turma->Result;

            $turma->consultar("select * from turno order by descricao");
            $linha2 = $turma->Linha;
            $rs2 = $turma->Result;

            if ($_POST['ok'] == 'true') {
                
                
             if ($_POST['idturno'] == 'TODOS') {
                 
                  $turma->consultar("select * from turma t inner join periodoletivo pl on(t.idperiodoletivo = pl.idperiodoletivo) inner join situacaoturma st 
on(t.idsituacaoturma = st.idsituacaoturma) INNER join turno on(t.idturno=turno.idturno) 
inner join disciplinas d on(t.sigladisciplina=d.sigladisciplina) 
left join matriculaprofessor mp on(t.matriculaprofessor = mp.matriculaprofessor) 
inner join grade_horario gh on(t.idgrade_horario = gh.idgrade_horario) inner join componentecurricular cc on(t.sigladisciplina=cc.sigladisciplina)
 where t.siglacurso='" . $_POST['siglacurso'] . "' and t.idperiodoletivo=" . $_POST['idperiodoletivo'] . " group by t.idturma order by turno.descricao, t.idturma,gh.descricao, d.descricao, st.descricao");
                $linha3 = $turma->Linha;
                $rs3 = $turma->Result;
             }else{
               $turma->consultar("select * from turma t inner join periodoletivo pl on(t.idperiodoletivo = pl.idperiodoletivo) inner join situacaoturma st 
on(t.idsituacaoturma = st.idsituacaoturma) INNER join turno on(t.idturno=turno.idturno) 
inner join disciplinas d on(t.sigladisciplina=d.sigladisciplina) 
left join matriculaprofessor mp on(t.matriculaprofessor = mp.matriculaprofessor) 
inner join grade_horario gh on(t.idgrade_horario = gh.idgrade_horario) inner join componentecurricular cc on(t.sigladisciplina=cc.sigladisciplina)
 where t.siglacurso='" . $_POST['siglacurso'] . "' and t.idperiodoletivo=" . $_POST['idperiodoletivo'] . " and t.idturno=" . $_POST['idturno'] . " group by t.idturma order by t.idturma,gh.descricao,turno.descricao, d.descricao, st.descricao");
                $linha3 = $turma->Linha;
                $rs3 = $turma->Result; 
                 
             }   
           
           }
            break;

        /* Edição de dados */
        case 'editar':
            //query ok
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $linha4;
            global $rs4;
            global $linha5;
            global $rs5;
            global $linha6;
            global $rs6;
            global $linha7;
            global $rs7;
            global $ln;
            global $r;
                
         $turma->consultar("select * from turma t inner join periodoletivo pl on(t.idperiodoletivo = pl.idperiodoletivo) inner join situacaoturma st 
on(t.idsituacaoturma = st.idsituacaoturma) INNER join turno on(t.idturno=turno.idturno) 
inner join disciplinas d on(t.sigladisciplina=d.sigladisciplina) 
left join matriculaprofessor mp on(t.matriculaprofessor = mp.matriculaprofessor) 
inner join grade_horario gh on(t.idgrade_horario = gh.idgrade_horario)
 where t.sigladisciplina='".$_GET['sigladisciplina']."' and t.idmatriz='" . $_GET['idmatriz'] . "' and t.idturma='" . $_GET['idturmas'] . "' and t.siglacurso='" . $_GET['siglacurso'] . "' and t.idperiodoletivo=" . $_GET['idperiodoletivo'] . " and t.idturno=" . $_GET['idturno'] . " and t.idgrade_horario=" . $_GET['idgrade_horario'] . " order by gh.descricao,turno.descricao, d.descricao, st.descricao");
            $ln = $turma->Linha;
            $r = $turma->Result;
            
 
            $turma->consultar("select * from curso order by siglacurso, descricao");
            $linha = $turma->Linha;
            $rs = $turma->Result;

            $turma->consultar("select * from turno order by descricao");
            $linha2 = $turma->Linha;
            $rs2 = $turma->Result;

            $turma->consultar("select * from disciplinas order by descricao");
            $linha3 = $turma->Linha;
            $rs3 = $turma->Result;

            $turma->consultar("select *, DATE_FORMAT(data_vigencia,'%d/%m/%Y') as vigencia from matriz order by data_vigencia desc");
            $linha4 = $turma->Linha;
            $rs4 = $turma->Result;

            $turma->consultar("select * from situacaoturma order by descricao");
            $linha5 = $turma->Linha;
            $rs5 = $turma->Result;

            $turma->consultar("select * from grade_horario order by descricao");
            $linha6 = $turma->Linha;
            $rs6 = $turma->Result;

            $turma->consultar("select * from pessoas p inner join professor prof on(p.idpessoas = prof.idpessoas) inner join matriculaprofessor mp 
on(prof.idpessoas = mp.idpessoas) order by mp.matriculaprofessor, p.nome");
            $linha7 = $turma->Linha;
            $rs7 = $turma->Result;

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Alterar

                    $turma->consultar("BEGIN");
                    $turma->Alterar($_GET['idturmas'],$_GET['idmatriz'],$_GET['siglacurso'],$_GET['sigladisciplina'],$_GET['idperiodoletivo'],$_GET['idgrade_horario'],$_POST['idturma'], $_POST['siglacurso'], $_POST['sigladisciplina'], $_POST['idmatriz'], $_POST['matriculaprofessor'], $_POST['idgrade_horario'], $_POST['idperiodoletivo'], $_POST['idturno'], $_POST['idsituacaoturma'], $_POST['qtdetotal']);
                    $turma->consultar("COMMIT");
                    $util->Msgbox('REGISTRO EDITADO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/turmas/consulta.php&form=Consulta de Turmas');
                } catch (Exception $ex) {
                    $turma->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;
            
            
    }
}

?>