<?php
session_start();
require_once('classes/unidade_escolar.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../index.php');
/* Function Processos */
global $Adm_modulos;

function Processo($Processo) {

    /* Atributos Globais */
    $util = new Util();
    $unidadeEscolar = new UnidadeEscolar();

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':
            global $linha;
            global $rs;

            $unidadeEscolar->consultar("select * from distrito order by descricao");
            $linha = $unidadeEscolar->Linha;
            $rs = $unidadeEscolar->Result;

            if ($_POST['ok'] == 'true') {
                $unidadeEscolar->verificar(utf8_decode(strtoupper($_POST['descricao'])));
                if ($unidadeEscolar->Achou == 'nao') {
                    try {

                        $unidadeEscolar->consultar("BEGIN");
                        $unidadeEscolar->incluir($_POST['inep'], strtoupper($_POST['descricao']), strtoupper($_POST['responsavel']), $_POST['endereco'], $_POST['cep'],strtoupper($_POST['bairro']),strtoupper($_POST['municipio']),$_POST['uf'], $_POST['telefone'], $_POST['celular'], $_POST['email'], $_POST['iddistrito']);
                        $unidadeEscolar->consultar("COMMIT");

                        $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                        $util->redirecionamentopage('default.php?pg='.base64_encode("view/unidade_escolar/consulta.php").'&form='.base64_encode("Consulta de Unidade Escolar"));
                    } catch (Exception $ex) {
                        $unidadeEscolar->consultar("ROLLBACK");
                        $util->msgbox("Falha de operacao");
                    }
                }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;

            $unidadeEscolar->consultar("select * from unidade_escolar ue inner join distrito d on(ue.iddistrito= d.iddistrito) order by d.descricao, ue.descricao");
            $linha = $unidadeEscolar->Linha;
            $rs = $unidadeEscolar->Result;

            if ($_POST['ok'] == 'true') {
                                
                $unidadeEscolar->consultar("select * from unidade_escolar ue inner join distrito d on(ue.iddistrito= d.iddistrito) where ue.descricao like '%" . $_POST['descricao'] . "%' order by d.descricao, ue.descricao");
                $linha = $unidadeEscolar->Linha;
                $rs = $unidadeEscolar->Result;
            }


            break;

        /* Edição de dados */
        case 'editar':
            global $linha;
            global $rs;
            global $linhaEditar;
            global $resultadoEditar;
            
            $unidadeEscolar->consultar("select * from distrito order by descricao");
            $linha = $unidadeEscolar->Linha;
            $rs = $unidadeEscolar->Result;
            
            $unidadeEscolar->consultar("select * from unidade_escolar where idunidade_escolar='".$_GET['id']."'");
            $linhaEditar = $unidadeEscolar->Linha;
            $resultadoEditar = $unidadeEscolar->Result;

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Incluir

                    $unidadeEscolar->consultar("BEGIN");
                    $unidadeEscolar->alterar($_GET['id'], $_POST['inep'], utf8_decode(strtoupper($_POST['descricao'])), strtoupper($_POST['responsavel']), $_POST['endereco'], $_POST['cep'], strtoupper($_POST['bairro']),strtoupper($_POST['municipio']),$_POST['uf'],$_POST['telefone'], $_POST['celular'], $_POST['email'], $_POST['iddistrito']);
                    $unidadeEscolar->consultar("COMMIT");

                   $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                        $util->redirecionamentopage('default.php?pg='.base64_encode("view/unidade_escolar/consulta.php").'&form='.base64_encode("Consulta de Unidade Escolar"));
                    }  catch (Exception $ex) {
                    $unidadeEscolar->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;
    }
}

?>