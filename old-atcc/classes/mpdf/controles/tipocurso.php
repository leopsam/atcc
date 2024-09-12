<?php
session_start();
require_once('classes/tipocurso.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../../index.php');
/* Function Processos */
global $Adm_modulos;

function Processo($Processo) {

    /* Atributos Globais */
    $util = new Util();
    $tipocurso = new TipoCurso();

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':
            
            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Incluir

                    $tipocurso->consultar("BEGIN");
                    $tipocurso->Incluir( utf8_decode($_POST['descricao']));
                    $tipocurso->consultar("COMMIT");

                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/tipocurso/consulta.php&form=Consulta de Tipo de Curso');
                } catch (Exception $ex) {
                    $tipocurso->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;
            $tipocurso->consultar("select * from tipocurso order by descricao");
            $linha = $tipocurso->Linha;
            $rs = $tipocurso->Result;

            if ($_POST['ok'] == 'true') {
                $tipocurso->consultar("select * from tipocurso where descricao like '%" . $_POST['descricao'] . "%' order by descricao");
                $linha = $tipocurso->Linha;
                $rs = $tipocurso->Result;
            }
            break;

        /* Edição de dados */
        case 'editar':
            //query ok
            global $linhaEditar;
            global $resultadoEditar;
            
         
            $tipocurso->consultar("select * from tipocurso where idtipocurso=".$_GET['id']);
            $linhaEditar = $tipocurso->Linha;
            $resultadoEditar = $tipocurso->Result;
            
            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Alterar

                    $tipocurso->consultar("BEGIN");
                    $tipocurso->Alterar($_GET['id'], utf8_decode($_POST['descricao']));
                    $tipocurso->consultar("COMMIT");
                    $util->msgbox('REGISTRO EDITADO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/tipocurso/consulta.php&form=Consulta de Tipo de Curso');
                } catch (Exception $ex) {
                    $tipocurso->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;
    }
}

?>