<?php

session_start();
require_once('classes/professor.php');
require_once('classes/usuarios.php');
require_once('classes/matriculaprofessor.php');
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
            $professor = new Professor();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();
            $matriculaProfessor = new MatriculaProfessor();
            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $professor->consultar("select * from titulacao t order by t.descricao");
            $linha = $professor->Linha;
            $rs = $professor->Result;

            $professor->consultar("select * from funcao f order by f.funcao");
            $linha2 = $professor->Linha;
            $rs2 = $professor->Result;

            if ($_POST['ok'] == 'true') {

                try {
                    $professor->consultar("BEGIN");
                    //inserindo usuário (perfil=> 1-ADMINISTRADOR, 2- SECRETARIA ACADÊMICA, 3-PROFESSOR, 4-ALUNO)
                    $idusuarios = $usuarios->Incluir($_POST['login'], base64_encode($_POST['senha']), 3);
                    //inserindo pessoas (Professor)
                    $idpessoas = $professor->IncluirPessoas($_POST['nome'], $_POST['sexo'], $_POST['endereco'], $_POST['bairro'], $_POST['cidade'], $_POST['cep'], $_POST['uf'], $util->formatoDataYMD($_POST['nascimento']), $_POST['nacionalidade'], $_POST['telefone'], $_POST['celular'], $_POST['email'], $foto, $idusuarios);

                    $idfuncionarios = $professor->IncluirFuncionario($idpessoas);


                    //atividades funcionais
                    $i = 0;
                    if (sizeof($_POST['idfuncao']) > 0) {
                        foreach ($_POST['idfuncao'] as $i => $v) {

                            $atividadesfuncionais->Incluir($idfuncionarios, $_POST['idfuncao'][$i], $util->formatoDataYMD($_POST['data_inicio'][$i]), $util->formatoDataYMD($_POST['data_termino'][$i]));
                        }
                    }


                    $professor->Incluir($idpessoas, $_POST['idtitulacao'], $_POST['cvlattes'], $_POST['nome_guerra'], $_POST['corfundo']);
                    if ($_POST['matricula1'] != '' && $_POST['ch1'] != '') {
                        $matriculaProfessor->verificarMatriculaProfessor($_POST['matricula1']);
                        if ($matriculaProfessor->Achou == 'nao') {


                            $matriculaProfessor->Incluir($_POST['matricula1'], $idpessoas, $_POST['ch1'], $util->formatoDataYMD($_POST['dtini1']), $util->formatoDataYMD($_POST['dtfim']));
                        }
                    }

                    if ($_POST['matricula2'] != '' && $_POST['ch2'] != '') {
                        $matriculaProfessor->verificarMatriculaProfessor($_POST['matricula2']);
                        if ($matriculaProfessor->Achou == 'nao') {

                            $matriculaProfessor->Incluir($_POST['matricula2'], $idpessoas, $_POST['ch2'], $util->formatoDataYMD($_POST['dtini1']), $util->formatoDataYMD($_POST['dtfim1']));
                        }
                    }
                    $descricao = "Realizado Cadastro do professor " . $_POST['nome'] . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Cadastro de novo professor";


                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                    $professor->consultar("COMMIT");
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/professor/consulta.php&form= Cadastro de Professor&idmodulos=2');
                } catch (Exception $ex) {
                    $professor->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
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
            $professor = new Professor();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();
            $matriculaProfessor = new MatriculaProfessor();
            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $professor->consultar("select * from titulacao t order by t.descricao");
            $linha = $professor->Linha;
            $rs = $professor->Result;

            $professor->consultar("select * from funcao f order by f.funcao");
            $linha2 = $professor->Linha;
            $rs2 = $professor->Result;


            $professor->consultar("select *, DATE_FORMAT(af.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(af.data_termino,'%d/%m/%Y') AS termino from funcionarios f inner join pessoas p 
on(p.idpessoas = f.idpessoas) inner join atividadesfuncionais af on(af.idfuncionarios = f.idfuncionarios) 
inner join funcao on(af.idfuncao=funcao.idfuncao)
where p.idpessoas=" . $_GET['id']);
            $ln2 = $professor->Linha;
            $r2 = $professor->Result;

            if ($_POST['ok'] == 'true') {

                try {
                    $professor->consultar("BEGIN");
                    $idfuncionarios = mysql_result($r2, 0, 'f.idfuncionarios');
                    $nome = utf8_encode(mysql_result($r2, 0, 'p.nome'));
                    $atividadesfuncionais->Incluir($idfuncionarios, $_POST['idfuncao'], $util->formatoDataYMD($_POST['data_inicio']), $util->formatoDataYMD($_POST['data_termino']));

                    $descricao = "Realizado novo cadastro de atividade do professor " . $nome . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Cadastro de nova atividade funcional";


                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                    $professor->consultar("COMMIT");
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/professor/consulta.php&form= Cadastro de Professor&idmodulos=2');
                } catch (Exception $ex) {
                    $professor->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'incluirMatricula':
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;

            $util = new Util();
            $professor = new Professor();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();
            $matriculaProfessor = new MatriculaProfessor();
            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $professor->consultar("select * from titulacao t order by t.descricao");
            $linha = $professor->Linha;
            $rs = $professor->Result;

            $professor->consultar("select * from funcao f order by f.funcao");
            $linha2 = $professor->Linha;
            $rs2 = $professor->Result;


            $professor->consultar("select *, DATE_FORMAT(af.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(af.data_termino,'%d/%m/%Y') AS termino from funcionarios f inner join pessoas p 
on(p.idpessoas = f.idpessoas) inner join atividadesfuncionais af on(af.idfuncionarios = f.idfuncionarios) 
inner join funcao on(af.idfuncao=funcao.idfuncao)
where p.idpessoas=" . $_GET['id']);
            $ln2 = $professor->Linha;
            $r2 = $professor->Result;

            if ($_POST['ok'] == 'true') {

                try {
                    $professor->consultar("BEGIN");
                    $idpessoas = mysql_result($r2, 0, 'p.idpessoas');
                    $nome = utf8_encode(mysql_result($r2, 0, 'p.nome'));
                    $matriculaProfessor->Incluir($_POST['matricula'], $idpessoas, $_POST['ch'], $util->formatoDataYMD($_POST['dtini']), $util->formatoDataYMD($_POST['dtfim']));
                    $descricao = "Realizado novo cadastro de matricula do professor " . $nome . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Cadastro de nova matrícula";


                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                    $professor->consultar("COMMIT");
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/professor/consulta.php&form= Cadastro de Professor&idmodulos=2');
                } catch (Exception $ex) {
                    $professor->consultar("ROLLBACK");
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
            $professor = new Professor();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();
            $matriculaProfessor = new MatriculaProfessor();
            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $professor->consultar("select *, DATE_FORMAT(p.nascimento,'%d/%m/%Y') AS dtnasc, DATE_FORMAT(mp.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(mp.data_fim,'%d/%m/%Y') AS termino from pessoas p inner join funcionarios f on(p.idpessoas = f.idpessoas) 
inner join professor prof on(prof.idpessoas = p.idpessoas) 
inner join matriculaprofessor mp on(prof.idpessoas = mp.idpessoas) inner join usuarios u on(p.idusuarios = u.idusuarios) 
where p.idpessoas=" . $_GET['id']);
            $ln = $professor->Linha;
            $r = $professor->Result;

            $professor->consultar("select * from titulacao t order by t.descricao");
            $linha = $professor->Linha;
            $rs = $professor->Result;

            if ($_POST['ok'] == 'true') {
                $idusuarios = mysql_result($r, 0, 'p.idusuarios');
                $idpessoas = mysql_result($r, 0, 'p.idpessoas');
                $idfuncionarios = mysql_result($r, 0, 'f.idfuncionarios');

                try {
                    $professor->consultar("BEGIN");
                    //atualizando usuário (perfil=> 1-ADMINISTRADOR, 2- SECRETARIA ACADÊMICA, 3-PROFESSOR, 4-ALUNO)
                    $usuarios->Alterar($idusuarios, $_POST['login'], base64_encode($_POST['senha']), 3);

                    //atualizando pessoas (Professor)
                    $professor->alterarPessoas($idpessoas, utf8_decode($_POST['nome']), utf8_decode($_POST['sexo']), $_POST['endereco'], $_POST['bairro'], $_POST['cidade'], $_POST['cep'], $_POST['uf'], $util->formatoDataYMD($_POST['nascimento']), $_POST['nacionalidade'], $_POST['telefone'], $_POST['celular'], $_POST['email'], $foto, $idusuarios);


                    //atualizando professor
                    $professor->Alterar($idpessoas, $_POST['idtitulacao'], $_POST['cvlattes'], $_POST['nome_guerra'], $_POST['corfundo']);


                    $descricao = "Realizado a Atualização do cadastro de professor " . $_POST['nome'] . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Atualização dos dados do professor";


                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                    $professor->consultar("COMMIT");
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/professor/consulta.php&form= Cadastro de Professor&idmodulos=2');
                } catch (Exception $ex) {
                    $professor->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'editarMatricula':
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
            $professor = new Professor();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();
            $matriculaProfessor = new MatriculaProfessor();
            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');


            $professor->consultar("select *, DATE_FORMAT(p.nascimento,'%d/%m/%Y') AS dtnasc, DATE_FORMAT(mp.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(mp.data_fim,'%d/%m/%Y') AS termino from pessoas p inner join funcionarios f on(p.idpessoas = f.idpessoas) 
inner join professor prof on(prof.idpessoas = p.idpessoas) 
inner join matriculaprofessor mp on(prof.idpessoas = mp.idpessoas) inner join usuarios u on(p.idusuarios = u.idusuarios) 
where mp.matriculaprofessor=" . $_GET['mat']);
            $ln = $professor->Linha;
            $r = $professor->Result;

            $professor->consultar("select * from titulacao t order by t.descricao");
            $linha = $professor->Linha;
            $rs = $professor->Result;

            if ($_POST['ok'] == 'true') {
                $idusuarios = mysql_result($r, 0, 'p.idusuarios');
                $idpessoas = mysql_result($r, 0, 'p.idpessoas');
                $nome = mysql_result($r, 0, 'p.nome');
                $idfuncionarios = mysql_result($r, 0, 'f.idfuncionarios');

                try {
                    $professor->consultar("BEGIN");

                    $matriculaProfessor->Alterar($_POST['matricula'], $idpessoas, $_POST['ch'], $util->formatoDataYMD($_POST['dtini']), $util->formatoDataYMD($_POST['dtfim']));
                    $descricao = "Realizado a Atualização dos dados da matrícula do professor " . utf8_encode($nome) . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Atualização dos dados do professor";


                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                    $professor->consultar("COMMIT");
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/professor/consulta.php&form= Cadastro de Professor&idmodulos=2');
                } catch (Exception $ex) {
                    $professor->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'editarAtividadeFuncional':
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
            $professor = new Professor();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();
            $matriculaProfessor = new MatriculaProfessor();
            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $professor->consultar("select *, DATE_FORMAT(af.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(af.data_termino,'%d/%m/%Y') AS termino from funcionarios f inner join pessoas p 
on(p.idpessoas = f.idpessoas) inner join atividadesfuncionais af on(af.idfuncionarios = f.idfuncionarios) 
inner join funcao on(af.idfuncao=funcao.idfuncao)
where af.idatividadesfuncionais=" . $_GET['id']);
            $ln2 = $professor->Linha;
            $r2 = $professor->Result;

            $professor->consultar("select * from funcao f order by f.funcao");
            $linha2 = $professor->Linha;
            $rs2 = $professor->Result;


            if ($_POST['ok'] == 'true') {
                $idatividadesfuncionais = mysql_result($r2, 0, 'af.idatividadesfuncionais');
                $idfuncionarios = mysql_result($r2, 0, 'f.idfuncionarios');
                $nome = mysql_result($r2, 0, 'p.nome');

                try {
                    $professor->consultar("BEGIN");

                    $atividadesfuncionais->Alterar($idatividadesfuncionais, $idfuncionarios, $_POST['idfuncao'], $util->formatoDataYMD($_POST['data_inicio']), $util->formatoDataYMD($_POST['data_termino']));
                    $descricao = "Realizado a Atualização dos dados da atividade funcional do professor " . utf8_encode($nome) . " pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Atualização dos dados do professor";


                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                    $professor->consultar("COMMIT");
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=view/professor/consulta.php&form= Cadastro de Professor&idmodulos=2');
                } catch (Exception $ex) {
                    $professor->consultar("ROLLBACK");
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
            $professor = new Professor();
            $ocorrencias = new Ocorrencias();
            $usuarios = new Usuarios();
            $matriculaProfessor = new MatriculaProfessor();
            $atividadesfuncionais = new AtividadeFuncionais();
            $util->Seguranca($_SESSION['idusuarios'], '../../index.php');

            $professor->consultar("select *, DATE_FORMAT(p.nascimento,'%d/%m/%Y') AS dtnasc, DATE_FORMAT(mp.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(mp.data_fim,'%d/%m/%Y') AS termino from pessoas p inner join funcionarios f on(p.idpessoas = f.idpessoas) 
inner join professor prof on(prof.idpessoas = p.idpessoas) 
inner join matriculaprofessor mp on(prof.idpessoas = mp.idpessoas) inner join usuarios u on(p.idusuarios = u.idusuarios) 
inner join titulacao t on(prof.idtitulacao=t.idtitulacao)
where p.idpessoas=" . $_GET['id']);
            $ln = $professor->Linha;
            $r = $professor->Result;

            $idfuncionarios = mysql_result($r, 0, 'f.idfuncionarios');

            $professor->consultar("select *, DATE_FORMAT(af.data_inicio,'%d/%m/%Y') AS inicio, 
DATE_FORMAT(af.data_termino,'%d/%m/%Y') AS termino from funcionarios f inner join pessoas p 
on(p.idpessoas = f.idpessoas) inner join atividadesfuncionais af on(af.idfuncionarios = f.idfuncionarios) 
inner join funcao on(af.idfuncao=funcao.idfuncao)
where p.idpessoas=" . $_GET['id']);
            $ln2 = $professor->Linha;
            $r2 = $professor->Result;

            break;

        case 'consulta':
            global $linha;
            global $rs;

            $professor = new Professor();
            $util = new Util();

            if ($_POST['ok'] == 'true') {

                if ($_POST['tipo'] == 'matricula') {
                    $professor->consultar("select * from professor prof inner join funcionarios f on(prof.idpessoas=f.idpessoas) inner join pessoas p 
on(p.idpessoas = prof.idpessoas) inner join matriculaprofessor mp on(mp.idpessoas=prof.idpessoas) where mp.matriculaprofessor='" . $_POST['criterio'] . "'");
                    $linha = $professor->Linha;
                    $rs = $professor->Result;
                    if ($linha > 0) {
                        $idpessoas = mysql_result($rs, 0, 'p.idpessoas');
                        $util->redirecionamentopage('default.php?pg=view/professor/visualizar.php&form=VISUALIZAÇÃO DOS DADOS DO PROFESSOR&id=' . $idpessoas);
                    }
                }

                if ($_POST['tipo'] == 'nome') {
                    $professor->consultar("select * from professor prof inner join funcionarios f on(prof.idpessoas=f.idpessoas) inner join pessoas p 
on(p.idpessoas = prof.idpessoas) where p.nome like '%" . $_POST['criterio'] . "%' order by p.nome");
                    $linha = $professor->Linha;
                    $rs = $professor->Result;
                }
            }
            break;
    }
}

?>