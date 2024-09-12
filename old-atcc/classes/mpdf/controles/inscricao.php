<?php

session_start();
require_once('classes/ocorrencias.php');
require_once('classes/candidatos.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../../index.php');

function Processo($Processo) {

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'consultar':

            /* Atributos Globais */
            $util = new Util();
            $inscricao = new Inscricao();
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;

            $inscricao->consultar("select * from curso order by siglacurso, descricao");
            $linha = $inscricao->Linha;
            $rs = $inscricao->Result;

            $inscricao->consultar("select * from pessoas p inner join professor prof on(p.idpessoas = prof.idpessoas) inner join matriculaprofessor mp 
on(prof.idpessoas = mp.idpessoas) order by p.nome, mp.matriculaprofessor, mp.carga_horaria");
            $linha2 = $inscricao->Linha;
            $rs2 = $inscricao->Result;


            if ($_POST['ok'] == 'true') {
                $inscricao->consultar("select * from turma t inner join curso c on(c.siglacurso=t.siglacurso) inner join disciplinas d on(t.sigladisciplina=d.sigladisciplina) 
inner join matriculaprofessor mp on(t.matriculaprofessor = mp.matriculaprofessor) inner join professor prof 
on(prof.idpessoas=mp.idpessoas) inner join pessoas p on(prof.idpessoas=p.idpessoas) 
inner join periodoletivo pl on(t.idperiodoletivo = pl.idperiodoletivo) 
inner join componentecurricular cc on(t.sigladisciplina=cc.sigladisciplina) inner join inscricao i on(t.idturma=i.idturma)
where t.siglacurso='" . $_POST['siglacurso'] . "' and t.idperiodoletivo='" . $_POST['idperiodoletivo'] . "' "
                        . "and t.matriculaprofessor='" . $_POST['matriculaprofessor'] . "' group by t.idturma order by t.idturma, d.descricao");
                $linha3 = $inscricao->Linha;
                $rs3 = $inscricao->Result;
            }
            break;
            
           
    }
}

?>