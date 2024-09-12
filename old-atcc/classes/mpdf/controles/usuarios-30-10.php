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
        /* incluir */
        case 'incluir':
            $util->Seguranca($_SESSION['idusuarios'], 'index.php');
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], 'index.php');
            $usuarios->consultar("select * from perfil order by descricao");
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            $usuarios->consultar("select * from unidade_escolar order by descricao");
            $linha2 = $usuarios->Linha;
            $rs2 = $usuarios->Result;

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Incluir

                    $usuarios->consultar("BEGIN");
                    $usuarios->incluir($_POST['nome'], $_POST['login'], base64_encode($_POST['senha']), $_POST['email'], $_POST['idperfil'], $_POST['idunidade_escolar'], $_POST['situacao']);
                    $usuarios->consultar("select * from perfil where idperfil=" . $_POST['idperfil']);
                    $linha = $usuarios->Linha;
                    $rs = $usuarios->Result;
                    $perfil = mysql_result($rs, 0, 'descricao');
                    $usuarios->EnviarEmail($_POST['login'], base64_encode($_POST['senha']), $_POST['email'], $perfil);
                    $usuarios->consultar("COMMIT");

                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/usuarios/consulta.php&form=Consulta de Usuário');
                } catch (Exception $ex) {
                    $usuarios->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'cadastroPais':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $login;

            $usuarios->consultar("select * from perfil order by descricao");
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            $usuarios->consultar("select * from unidade_escolar order by descricao");
            $linha2 = $usuarios->Linha;
            $rs2 = $usuarios->Result;
            
            
            if ($_POST['ok'] == 'true') {
                $usuarios->verificarCPF($_POST['login']);
               if($usuarios->Achou == 'nao') { 
                try {
                    //Chamar Incluir
                    $idperfil = 7;
                    $usuarios->consultar("BEGIN");                    
                    $usuarios->incluir($_POST['nome'], $_POST['login'], base64_encode($_POST['senha']), $_POST['email'], $idperfil, 137, 'ATIVO');
                    $usuarios->consultar("select * from perfil where idperfil=" . $idperfil);
                    $linha = $usuarios->Linha;
                    $rs = $usuarios->Result;
                    $perfil = mysql_result($rs, 0, 'descricao');
                    $usuarios->EnviarEmail($_POST['login'], $_POST['senha'], $_POST['email'], $perfil);
                    $usuarios->consultar("COMMIT");

                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('index.php');
                } catch (Exception $ex) {
                    $usuarios->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
               } 
            }
            break;
        /* Edi��o de dados */
        case 'editar':
            //query ok
            global $linhaEditar;
            global $resultadoEditar;
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            $util = new Util();
            $util->Seguranca($_SESSION['idusuarios'], 'index.php');
            $usuarios->consultar("select * from perfil order by descricao");
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            $usuarios->consultar("select * from unidade_escolar order by descricao");
            $linha2 = $usuarios->Linha;
            $rs2 = $usuarios->Result;

            $usuarios->consultar("select * from usuarios where idusuarios=" . $_GET['id']);
            $linhaEditar = $usuarios->Linha;
            $resultadoEditar = $usuarios->Result;
            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Alterar

                    $usuarios->consultar("BEGIN");

                    $usuarios->alterar($_GET['id'], $_POST['nome'], $_POST['login'], $_POST['senha'], $_POST['email'], $_POST['idperfil'], $_POST['idunidade_escolar'], $_POST['situacao']);

                    $descricao = "Atualização dos dados do usuário " . mysql_result($resultadoEditar, 0, 'login') . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Atualização de senha";
                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));

                    $usuarios->consultar("select * from perfil where idperfil=" . $_POST['idperfil']);
                    $linha = $usuarios->Linha;
                    $rs = $usuarios->Result;
                    $perfil = mysql_result($rs, 0, 'descricao');
                    $usuarios->EnviarEmail($_POST['login'], $_POST['senha'], $_POST['email'], $perfil);

                    $usuarios->consultar("COMMIT");
                    $util->msgbox('REGISTRO EDITADO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('view/usuarios/consulta.php') . '&form=' . base64_encode('Consulta de Usuário'));
                } catch (Exception $ex) {
                    $usuarios->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;
            $usuarios->consultar("select * from usuarios u inner join unidade_escolar ue on(u.idunidade_escolar=ue.idunidade_escolar) order by u.nome, ue.descricao");
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            if ($_POST['ok'] == 'true') {
                $usuarios->consultar("select * from usuarios u inner join unidade_escolar ue on(u.idunidade_escolar=ue.idunidade_escolar) where nome like '%" . $_POST['nome'] . "%' order by nome");
                $linha = $usuarios->Linha;
                $rs = $usuarios->Result;
            }
            break;

        case 'alterarsenha':
            //query ok
            global $linhaEditar;
            global $resultadoEditar;


            $usuarios->consultar("select * from usuarios inner join perfil on(usuarios.idperfil = perfil.idperfil) where idusuarios=" . $_SESSION['idusuarios']);
            $linhaEditar = $usuarios->Linha;
            $resultadoEditar = $usuarios->Result;
            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Alterar

                    $usuarios->consultar("BEGIN");
                    $usuarios->alteraSenha($_SESSION['idusuarios'], base64_encode($_POST['senha']));

                    $descricao = "Atualização dos dados do usuário " . mysql_result($resultadoEditar, 0, 'login') . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Atualização de senha";
                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));

                    $usuarios->consultar("COMMIT");
                    $util->msgbox('REGISTRO EDITADO COM SUCESSO!');
                    $util->redirecionamentopage('index.php');
                } catch (Exception $ex) {
                    $usuarios->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;
    }
}

?>