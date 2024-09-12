<?php

session_start();
require_once('classes/usuarios.php');
require_once('classes/util.php');
require_once('classes/ocorrencias.php');

function Processo($Processo) {

    /* Atributos Globais */
    $util = new Util();
    $usuarios = new Usuarios();
    $ocorrencias = new Ocorrencias();

    /* Switch processos */
    switch ($Processo) {
        case 'publico':
            $util->Seguranca($_SESSION['idusuarios'], 'index.php');
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;

            //vagas oferecidas para pré-inscrição
            $usuarios->consultar("select ts.descricao,sum(v.totalvagas) as total from vagas v inner JOIN segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) 
inner join unidade_escolar ue on(v.idunidade_escolar=ue.idunidade_escolar) inner join tiposegmento ts 
on(se.idtipo_segmento = ts.idtipo_segmento) 
where v.tipovaga='INSCRICAO' AND v.idunidade_escolar NOT IN(66,164,1,2,67,125,180) 
group by ts.descricao order by ts.descricao;");
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            //vagas oferecidas para Transferências
            $usuarios->consultar("select ts.descricao,sum(v.totalvagas) as total from vagas v inner JOIN segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) 
inner join unidade_escolar ue on(v.idunidade_escolar=ue.idunidade_escolar) inner join tiposegmento ts 
on(se.idtipo_segmento = ts.idtipo_segmento) 
where v.tipovaga='TRANSFERENCIA' AND v.idunidade_escolar NOT IN(66,164,1,2,67,125,180) 
group by ts.descricao order by ts.descricao;");
            $linha2 = $usuarios->Linha;
            $rs2 = $usuarios->Result;

            //Inscrições realizadas pelo usuário
            $usuarios->consultar("select * from inscricao i inner join candidatos c on(i.idcandidatos = c.idcandidatos) 
inner join usuarios u on(i.idusuarios = u.idusuarios) where u.idusuarios=" . $_SESSION['idusuarios']);
            $linha3 = $usuarios->Linha;
            $rs3 = $usuarios->Result;
            break;

        case 'publicoGestao':
            $util->Seguranca($_SESSION['idusuarios'], 'index.php');
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;

            //vagas oferecidas para pré-inscrição
            $usuarios->consultar("select ts.descricao,sum(v.totalvagas) as total from vagas v inner JOIN segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) 
inner join unidade_escolar ue on(v.idunidade_escolar=ue.idunidade_escolar) inner join tiposegmento ts 
on(se.idtipo_segmento = ts.idtipo_segmento) 
where v.tipovaga='INSCRICAO' AND v.idunidade_escolar NOT IN(66,164,1,2,67,125,180) 
group by ts.descricao order by ts.descricao;");
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            //vagas oferecidas para Transferências
            $usuarios->consultar("select ts.descricao,sum(v.totalvagas) as total from vagas v inner JOIN segmentoescolar se on(v.idsegmento_escolar = se.idsegmento_escolar) 
inner join unidade_escolar ue on(v.idunidade_escolar=ue.idunidade_escolar) inner join tiposegmento ts 
on(se.idtipo_segmento = ts.idtipo_segmento) 
where v.tipovaga='TRANSFERENCIA' AND v.idunidade_escolar NOT IN(66,164,1,2,67,125,180) 
group by ts.descricao order by ts.descricao;");
            $linha2 = $usuarios->Linha;
            $rs2 = $usuarios->Result;

            //Inscrições realizadas pelo usuário
            $usuarios->consultar("select ts.descricao,COUNT(*) as total from inscricao i inner join candidatos c on(i.idcandidatos = c.idcandidatos) 
inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar) 
inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
inner join distrito d on(ue.iddistrito = d.iddistrito) inner join tiposegmento ts on(se.idtipo_segmento = ts.idtipo_segmento)
where i.idunidade_escolar NOT IN(66,164,1,2,67,125,180) and i.fase='SEGUNDA' and ts.idtipo_segmento=4 and i.idtipoinscricao=1 
group by ts.descricao;");
            $linha3 = $usuarios->Linha;
            $rs3 = $usuarios->Result;
            break;
        
        case 'consulta':
            require_once('classes/candidatos.php');
            global $linha;
            global $rs;

            $candidatos = new Candidatos();
            $util = new Util();

            if ($_POST['ok'] == 'true') {

                if ($_POST['tipo'] == 'matricula') {
                    $candidatos->consultar("select *, date_format(nascimento, '%d/%m/%Y') as dtnasc,  date_format(i.dtreg, '%d/%m/%Y %H:%i:%s') as dtinscricao from candidatos c inner join inscricao i ON(c.idcandidatos = i.idcandidatos) 
 inner join usuarios u ON(i.idusuarios = u.idusuarios) inner join rendafamiliar rf on(c.idrendafamiliar =rf.idrendafamiliar) 
 inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
 inner join tipoinscricao ti ON(i.idtipoinscricao = ti.idtipoinscricao) 
 inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento) where i.idinscricao='" . $_POST['criterio'] . "'");
                    $linha = $candidatos->Linha;
                    $rs = $candidatos->Result;
                    
                                if ($linha > 0) {
                        $idcandidatos = @mysql_result($rs, 0, 'i.idcandidatos');
                        echo"<script>window.open('view/candidatos/ficha2.php?&id=" . $idcandidatos . "');</script>";
                    }
                }

                if ($_POST['tipo'] == 'nome') {
                    $candidatos->consultar("select *, date_format(nascimento, '%d/%m/%Y') as dtnasc,  date_format(i.dtreg, '%d/%m/%Y %H:%i:%s') as dtinscricao from candidatos c inner join inscricao i ON(c.idcandidatos = i.idcandidatos) 
 inner join usuarios u ON(i.idusuarios = u.idusuarios) inner join rendafamiliar rf on(c.idrendafamiliar =rf.idrendafamiliar) 
 inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
 inner join tipoinscricao ti ON(i.idtipoinscricao = ti.idtipoinscricao) 
 inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento) where  c.cpf ='".$_POST['criterio']."' order by c.nome");
                   
                      
                    $linha = $candidatos->Linha;
                    $rs = $candidatos->Result;
                }
            }
            break;
    }
}

?>