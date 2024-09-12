<?php

session_start();
require_once('classes/ocorrencias.php');
require_once('classes/util.php');


function Processo($Processo) {
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

            $util = new Util();
            $ocorrencias = new Ocorrencias();

            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

           if ($_SESSION['idperfil'] == 1) {
                $ocorrencias->consultar("select *, date_format(data_hora,'%d/%m/%Y %H:%i:%s') as dh from ocorrencias where situacao<>'VALIDADA' order by data_hora desc");
                $linha = $ocorrencias->Linha;
                $rs = $ocorrencias->Result;
            } else {
                 
                $ocorrencias->consultar("select *,date_format(o.data_hora,'%d/%m/%Y %H:%i:%s') as dh from ocorrencias o inner join usuarios u on(o.idusuarios = u.idusuarios) "
                        . "inner join perfil p on(u.idperfil=p.idperfil) where o.situacao<>'VALIDADA' and u.idperfil<>1 and u.idunidade_escolar=" . $_SESSION['idunidade_escolar']);
                $linha = $ocorrencias->Linha;
                $rs = $ocorrencias->Result;
            }

            if ($_POST['ok'] == 'true') {
                try {
                    $ocorrencias->consultar("BEGIN");
                    for ($i = 0; $i < $linha; $i++) {
                        $idocorrencias = mysql_result($rs, $i, 'idocorrencias');
                        if ($_POST['ch' . $i] == "on") {
                            $ocorrencias->Alterar($idocorrencias, "VALIDADA");
                            $ocorrencias->consultar("COMMIT");
                        }
                    }

                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg='.base64_encode("view/ocorrencias/ocorrencias.php").'&form='.base64_encode("Ocorrências que merecem atenção"));
                } catch (Exception $ex) {
                    
                }
            }
            break;
        /* Edição de dados */
        case 'editar':
            //query ok
            global $linhaEditar;
            global $resultadoEditar;

            $util = new Util();
            $ocorrencias = new Adm_menu();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $ocorrencias->consultar("select * from adm_menu am inner join adm_modulos amod on(am.idmodulos=amod.idmodulos) 
inner join adm_sistemas adms ON(amod.idsistemas=adms.idsistemas) 
where am.idmenu=" . $_GET['id']);
            $linhaEditar = $ocorrencias->Linha;
            $resultadoEditar = $ocorrencias->Result;
            if ($_POST['ok'] == 'true') {
                
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;

            $ocorrencias = new Ocorrencias();


            $ocorrencias->consultar("select *, date_format(data_hora,'%d/%m/%Y %H:%i:%s') as dh from ocorrencias where situacao<>'VALIDADA' order by data_hora desc");
            $linha = $ocorrencias->Linha;
            $rs = $ocorrencias->Result;

            break;
    }
}

?>