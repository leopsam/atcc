<?php

session_start();
require_once('classes/funcionarios.php');
require_once('classes/usuarios.php');
require_once('classes/atividadesfuncionais.php');
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
            $funcionarios = new Funcionarios();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();

            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');


            $funcionarios->consultar("select * from funcao f order by f.funcao");
            $linha2 = $funcionarios->Linha;
            $rs2 = $funcionarios->Result;

            if ($_POST['ok'] == 'true') {

                $funcionarios->verificar($_POST['email'], $_POST['nome']);
                if ($funcionarios->Achou == 'nao') {
                    try {
                        $funcionarios->consultar("BEGIN");
                        //inserindo usuário (perfil=> 1-ADMINISTRADOR, 2- SECRETARIA ACADÊMICA, 3-PROFESSOR, 4-ALUNO)
                        $idusuarios = $usuarios->Incluir($_POST['login'], base64_encode($_POST['senha']), 2);
                        //inserindo pessoas (Professor)
                        if ($foto == "") {
                            $foto = "sem_foto.jpg";
                        }
                        $idpessoas = $funcionarios->IncluirPessoas($_POST['nome'], $_POST['sexo'], $_POST['endereco'], $_POST['bairro'], $_POST['cidade'], $_POST['cep'], $_POST['uf'], $util->formatoDataYMD($_POST['nascimento']), $_POST['nacionalidade'], $_POST['telefone'], $_POST['celular'], $_POST['email'], $foto, $idusuarios);
                        $idfuncionarios = $funcionarios->IncluirFuncionario($idpessoas);
                        $atividadesfuncionais->Incluir($idfuncionarios, $_POST['idfuncao'], $data_inicio, $data_termino);
                        //atividades funcionais

                        $descricao = "Realizado Cadastro do funcionário " . $_POST['nome'] . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                        $funcionalidade = "Cadastro de novo funcionário";


                        $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                        $funcionarios->consultar("COMMIT");
                        $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                        $util->redirecionamentopage('default.php?pg=view/funcionarios/consulta.php&form= Cadastro de Funcionários do Apoio Administrativo&idmodulos=2');
                    } catch (Exception $ex) {
                        $funcionarios->consultar("ROLLBACK");
                        $util->msgbox("Falha de operacao");
                    }
                }
            }
            break;



        case 'incluirAtividadeFuncional':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;

            $util = new Util();
            $funcionarios = new Professor();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();
            $matriculaProfessor = new MatriculaProfessor();
            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $funcionarios->consultar("select * from funcao f order by f.funcao");
            $linha2 = $funcionarios->Linha;
            $rs2 = $funcionarios->Result;


            $funcionarios->consultar("select *, DATE_FORMAT(af.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(af.data_termino,'%d/%m/%Y') AS termino from funcionarios f inner join pessoas p 
on(p.idpessoas = f.idpessoas) inner join atividadesfuncionais af on(af.idfuncionarios = f.idfuncionarios) 
inner join funcao on(af.idfuncao=funcao.idfuncao)
where p.idpessoas=" . $_GET['id']);
            $ln2 = $funcionarios->Linha;
            $r2 = $funcionarios->Result;

            if ($_POST['ok'] == 'true') {

                try {
                    $funcionarios->consultar("BEGIN");
                    $idfuncionarios = mysql_result($r2, 0, 'f.idfuncionarios');
                    $nome = utf8_encode(mysql_result($r2, 0, 'p.nome'));
                    $atividadesfuncionais->Incluir($idfuncionarios, $_POST['idfuncao'], $util->formatoDataYMD($_POST['data_inicio']), $util->formatoDataYMD($_POST['data_termino']));

                    $descricao = "Realizado novo cadastro de atividade do professor " . $nome . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Cadastro de nova atividade funcional";


                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                    $funcionarios->consultar("COMMIT");
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/professor/consulta.php&form= Cadastro de Professor&idmodulos=2');
                } catch (Exception $ex) {
                    $funcionarios->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;


        case 'editarDados':
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
            $funcionarios = new Funcionarios();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();
            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $funcionarios->consultar("select *,DATE_FORMAT(p.nascimento,'%d/%m/%Y') AS dtnasc from funcionarios f inner join pessoas p on(f.idpessoas = p.idpessoas) 
inner JOIN usuarios u on(p.idusuarios = u.idusuarios) inner join atividadesfuncionais af 
on(af.idfuncionarios = f.idfuncionarios) inner join funcao fun on(af.idfuncao = fun.idfuncao) 
where p.idpessoas =" . $_GET['id']);
            $ln = $funcionarios->Linha;
            $r = $funcionarios->Result;

            $funcionarios->consultar("select * from funcao f order by f.funcao");
            $linha2 = $funcionarios->Linha;
            $rs2 = $funcionarios->Result;

            if ($_POST['ok'] == 'true') {
                $idusuarios = mysql_result($r, 0, 'p.idusuarios');
                $idpessoas = mysql_result($r, 0, 'p.idpessoas');
                $login = mysql_result($r, 0, 'u.login');
                $idfuncionarios = mysql_result($r, 0, 'f.idfuncionarios');
                $idatividadesfuncionais = mysql_result($r, 0, 'af.idatividadesfuncionais');
                $data_inicio = mysql_result($r, 0, 'af.data_inicio');
                $data_termino = mysql_result($r, 0, 'af.data_termino');
                try {
                    $funcionarios->consultar("BEGIN");
                    //atualizando usuário (perfil=> 1-ADMINISTRADOR, 2- SECRETARIA ACADÊMICA, 3-PROFESSOR, 4-ALUNO)
                    $usuarios->Alterar($idusuarios, $login, base64_encode($_POST['senha']), 2);

                    //atualizando pessoas (Professor)
                    $funcionarios->alterarPessoas($idpessoas, utf8_decode($_POST['nome']), utf8_decode($_POST['sexo']), $_POST['endereco'], $_POST['bairro'], $_POST['cidade'], $_POST['cep'], $_POST['uf'], $util->formatoDataYMD($_POST['nascimento']), $_POST['nacionalidade'], $_POST['telefone'], $_POST['celular'], $_POST['email'], $foto, $idusuarios);


                    //atualizando atividades funcionais
                    $atividadesfuncionais->Alterar($idatividadesfuncionais, $idfuncionarios, $_POST['idfuncao'], $data_inicio, $data_termino);
                    $descricao = "Realizado a Atualização do cadastro do funcionário " . $_POST['nome'] . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Atualização dos dados do funcionário de apoio administrativo";


                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                    $funcionarios->consultar("COMMIT");
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/funcionarios/consulta.php&form= Cadastro de Funcionários do Apoio Administrativo');
                } catch (Exception $ex) {
                    $funcionarios->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;



        case 'visualizarDados':
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
            $funcionarios = new Funcionarios();
            $ocorrencias = new Ocorrencias();

            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $funcionarios->consultar("select *,DATE_FORMAT(p.nascimento,'%d/%m/%Y') AS dtnasc from funcionarios f inner join pessoas p on(f.idpessoas = p.idpessoas) 
inner JOIN usuarios u on(p.idusuarios = u.idusuarios) inner join atividadesfuncionais af 
on(af.idfuncionarios = f.idfuncionarios) inner join funcao fun on(af.idfuncao = fun.idfuncao) 
where p.idpessoas =" . $_GET['id']);
            $ln = $funcionarios->Linha;
            $r = $funcionarios->Result;


            break;

        case 'consulta':
            global $linha;
            global $rs;

            $funcionarios = new Funcionarios();
            $util = new Util();

            if ($_POST['ok'] == 'true') {

                $funcionarios->consultar("select * from usuarios u inner join pessoas p on(u.idusuarios=p.idusuarios) inner join funcionarios f on(f.idpessoas=p.idpessoas) inner join atividadesfuncionais
                    af on(f.idfuncionarios= af.idfuncionarios) inner join funcao fun on(af.idfuncao = fun.idfuncao)
    where p.nome like '%" . $_POST['criterio'] . "%' and u.idperfil not IN(3,4) order by p.nome, u.idperfil");
                $linha = $funcionarios->Linha;
                $rs = $funcionarios->Result;
            }
            break;
    }
}

?>