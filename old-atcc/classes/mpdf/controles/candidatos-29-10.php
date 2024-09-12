<?php

session_start();

require_once('classes/ocorrencias.php');
require_once('classes/candidatos.php');
require_once('classes/vagas.php');
require_once('classes/util.php');
$util = new Util();
$util->Seguranca($_SESSION['idusuarios'], '../index.php');

//echo gethostbyaddr($_SERVER['REMOTE_ADDR']); 
function Processo($Processo) {

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':

            /* Atributos Globais */
            $util = new Util();
            $candidatos = new Candidatos();
            $ocorrencias = new Ocorrencias();
            $vagas = new Vagas();
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $linha4;
            global $rs4;
            $idtipoinscricao = base64_decode($_GET['ti']);

            if ($_SESSION['idperfil'] == 7) {
                $login = $_SESSION['login'];
            } else {
                $login = $_POST['cpf'];
            }
            if ($idtipoinscricao == 1) {
                $candidatos->consultar("select * from tiposegmento where idtipo_segmento=1 or idtipo_segmento=2 or idtipo_segmento=4");
                $linha2 = $candidatos->Linha;
                $rs2 = $candidatos->Result;
            } elseif ($idtipoinscricao == 2) {
                $candidatos->consultar("select * from tiposegmento where idtipo_segmento=1 or idtipo_segmento=2");
                $linha2 = $candidatos->Linha;
                $rs2 = $candidatos->Result;
            }

            $candidatos->consultar("select * from rendafamiliar");
            $linha3 = $candidatos->Linha;
            $rs3 = $candidatos->Result;

            $candidatos->consultar("select * from unidade_escolar where idunidade_escolar <>137 order by descricao");
            $linha4 = $candidatos->Linha;
            $rs4 = $candidatos->Result;

            if ($_POST['auditiva'] == 'on') {
                $auditiva = 'AUDITIVA';
            }
            if ($_POST['visual'] == 'on') {
                $visual = 'VISUAL';
            }
            if ($_POST['motora'] == 'on') {
                $motora = 'MOTORA';
            }
            if ($_POST['intelectual'] == 'on') {
                $intelectual = 'INTELECTUAL';
            }
            if ($_POST['multipla'] == 'on') {
                $multipla = 'MULTIPLA';
            }
			if ($_POST['transtorno_global'] == 'on') {
                $transtorno_global = 'TRANSTORNO GLOBAL';
            }


            if ($_POST['ok'] == 'true') {
                try {
                    if ($idtipoinscricao == 1) {
                        $candidatos->consultar("BEGIN");
                        //Chamar Incluir
						
												
                        $idcandidatos = $candidatos->incluir($idtipoinscricao, $_POST['nome'], $_POST['pai'], $_POST['mae'], $util->formatoDataYMD($_POST['nascimento']), $_POST['sexo'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['uf'], $_POST['cep'], $_POST['telefone'], $_POST['celular'], $_POST['idrendafamiliar'], $_POST['responsavel'], $_POST['cpf'], $_POST['rg'], $_POST['email'], $auditiva, $visual, $motora, $intelectual, $multipla,$transtorno_global, $_POST['deficiencias_outras'],$_POST['idade'], $_SESSION['idusuarios'], $_POST['idsegmento_escolar'], $_POST['idunidade_escolar'], $_POST['idunidade_escolar2'],$_POST['idunidade_escolar3'],$_POST['idunidade_escolar4'],$_POST['idunidade_escolar5'],$_POST['camisa_aluno'],$_POST['bermuda_aluno'],$_POST['pe_aluno']);
                        
						$descricao = "Realizado Cadastro do Candidato <b>" . $_POST['nome'] . "</b> pelo usuário <b>" . $_SESSION['login'] . "</b>";
                        $funcionalidade = "Cadastro de novo candidato";
                        $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));

                        $candidatos->consultar("COMMIT");
                        $pg = "view/candidatos/ficha.php?&id=" . $idcandidatos;
                        //$pg= base64_encode($pg);
                        echo"<script>window.open('" . $pg . "');</script>";
                        $pg = 'default.php?pg=' . base64_encode("view/candidatos/incluir.php") . '&form=' . base64_encode("Pr&eacute;-inscri&ccedil;&atilde;o de Candidato") . '&ti=' . $_GET['ti'];

                        $pg2 = 'default.php?pg=' . base64_encode("view/ocorrencias/ocorrencias.php") . '&form=' . base64_encode("Ocorr&ecirc;ncias que merecem aten&ccedil;&atilde;o");

                        $util->MsgboxSimNaoNovoCad("Registro salvo com sucesso! Deseja Cadastrar um novo Candidato?", $pg, $pg2);
                    }
					//Só está pesquisando a idunidade_escolar, faltam os outros -->
                    $vagas->verificarVagas($_POST['idunidade_escolar'], $_POST['idsegmento_escolar']);
					
					
                    
                    if ($idtipoinscricao == 2 && $vagas->Achou == 'sim') {
                        $candidatos->consultar("BEGIN");
                        //Chamar Incluir
                        //						
                        $idcandidatos = $candidatos->incluir($_POST['nome'], $_POST['pai'], $_POST['mae'], $util->formatoDataYMD($_POST['nascimento']), $_POST['sexo'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['uf'], $_POST['cep'], $_POST['telefone'], $_POST['celular'], $_POST['idrendafamiliar'], $_POST['responsavel'], $_POST['cpf'], $_POST['rg'], $_POST['email'], $auditiva, $visual, $motora, $intelectual, $multipla,$transtorno_global, $_POST['deficiencias_outras'], $_POST['idade'], $_SESSION['idusuarios'], $_POST['idsegmento_escolar'], $idtipoinscricao, $_POST['idunidade_escolar'], $_POST['idunidade_escolar2'],$_POST['idunidade_escolar3'],$_POST['idunidade_escolar4'],$_POST['idunidade_escolar5'],$_POST['camisa_aluno'],$_POST['bermuda_aluno'],$_POST['pe_aluno']);
                        $descricao = "Realizado Cadastro do Candidato <b>" . $_POST['nome'] . "</b> pelo usuário <b>" . $_SESSION['login'] . "</b>";
                        $funcionalidade = "Cadastro de novo candidato";
                        $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                        $vagas->atualizaQuadroVagas($_POST['idunidade_escolar'], $_POST['idunidade_escolar2'],$_POST['idunidade_escolar3'],$_POST['idunidade_escolar4'],$_POST['idunidade_escolar5'], 2);

                        $candidatos->consultar("COMMIT");
                        $pg = "view/candidatos/ficha.php?&id=" . $idcandidatos;
                        //$pg= base64_encode($pg);
                        echo"<script>window.open('" . $pg . "');</script>";
                        $pg = 'default.php?pg=' . base64_encode("view/candidatos/incluir.php") . '&form=' . base64_encode("Transfer&ecirc;ncia de Aluno") . '&ti=' . $_GET['ti'];

                        $pg2 = 'default.php?pg=' . base64_encode("view/ocorrencias/ocorrencias.php") . '&form=' . base64_encode("Ocorr&ecirc;ncias que merecem aten&ccedil;&atilde;o");

                        $util->MsgboxSimNaoNovoCad("Registro salvo com sucesso! Deseja Cadastrar um novo Candidato?", $pg, $pg2);
                    }
                } catch (Exception $ex) {
                    $candidatos->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'incluirOld':

            /* Atributos Globais */
            $util = new Util();
            $candidatos = new Candidatos();
            $ocorrencias = new Ocorrencias();
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $linha4;
            global $rs4;

            $candidatos->consultar("select * from tiposegmento where idtipo_segmento =4");
            $linha2 = $candidatos->Linha;
            $rs2 = $candidatos->Result;

            $candidatos->consultar("select * from rendafamiliar");
            $linha3 = $candidatos->Linha;
            $rs3 = $candidatos->Result;

            $candidatos->consultar("select * from unidade_escolar where idunidade_escolar <>137 order by descricao");
            $linha4 = $candidatos->Linha;
            $rs4 = $candidatos->Result;


            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Incluir
                    $candidatos->consultar("BEGIN");
                    if ($_POST['auditiva'] == 'on') {
                        $auditiva = 'AUDITIVA';
                    }
                    if ($_POST['visual'] == 'on') {
                        $visual = 'VISUAL';
                    }
                    if ($_POST['motora'] == 'on') {
                        $motora = 'MOTORA';
                    }
                    if ($_POST['intelectual'] == 'on') {
                        $intelectual = 'INTELECTUAL';
                    }
                    if ($_POST['multipla'] == 'on') {
                        $multipla = 'MULTIPLA';
                    }
                    $idtipoinscricao = base64_decode($_GET['ti']);

                    $idcandidatos = $candidatos->incluir($_POST['nome'], $_POST['pai'], $_POST['mae'], $util->formatoDataYMD($_POST['nascimento']), $_POST['sexo'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['uf'], $_POST['cep'], $_POST['telefone'], $_POST['celular'], $_POST['idrendafamiliar'], $_POST['responsavel'], $_POST['cpf'], $_POST['rg'], $_POST['email'], $auditiva, $visual, $motora, $intelectual, $multipla,$transtorno_global, $_POST['deficiencias_outras'], $_POST['idade'], $_SESSION['idusuarios'], $_POST['idsegmento_escolar'], $idtipoinscricao, $_POST['idunidade_escolar'], $_POST['idunidade_escolar2'],$_POST['idunidade_escolar3'],$_POST['idunidade_escolar4'],$_POST['idunidade_escolar5'],$_POST['camisa_aluno'],$_POST['bermuda_aluno'],$_POST['pe_aluno']);

                    $descricao = "Realizado Cadastro do Candidato <b>" . $_POST['nome'] . "</b> pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Cadastro de novo candidato";
                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));

                    $candidatos->consultar("select * from tiposegmento");
                    $linha = $candidatos->Linha;
                    $rs = $candidatos->Result;

                    $candidatos->consultar("COMMIT");
                    $pg = "view/candidatos/ficha.php?&id=" . $idcandidatos;
                    //$pg= base64_encode($pg);
                    echo"<script>window.open('" . $pg . "');</script>";
                    $pg = 'default.php?pg=' . base64_encode("view/candidatos/incluirOld.php") . '&form=' . base64_encode("Pr&eacute;-inscri&ccedil;&atilde;o de Candidato") . '&ti=' . $_GET['ti'];

                    $pg2 = 'default.php?pg=' . base64_encode("view/ocorrencias/ocorrencias.php") . '&form=' . base64_encode("Ocorr&ecirc;ncias que merecem aten&ccedil;&atilde;o");

                    $util->MsgboxSimNaoNovoCad("Registro salvo com sucesso! Deseja Cadastrar um novo Candidato?", $pg, $pg2);
                } catch (Exception $ex) {
                    $candidatos->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'consulta':
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
                        echo"<script>window.open('view/candidatos/ficha.php?&id=" . $idcandidatos . "');</script>";
                    }
                }

                if ($_POST['tipo'] == 'nome') {
                    $candidatos->consultar("select *, date_format(nascimento, '%d/%m/%Y') as dtnasc,  date_format(i.dtreg, '%d/%m/%Y %H:%i:%s') as dtinscricao from candidatos c inner join inscricao i ON(c.idcandidatos = i.idcandidatos) 
 inner join usuarios u ON(i.idusuarios = u.idusuarios) inner join rendafamiliar rf on(c.idrendafamiliar =rf.idrendafamiliar) 
 inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
 inner join tipoinscricao ti ON(i.idtipoinscricao = ti.idtipoinscricao) 
 inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento) where  c.nome like '%" . $_POST['criterio'] . "%' order by c.nome");
                    $linha = $candidatos->Linha;
                    $rs = $candidatos->Result;
                }
            }
            break;

            case 'consultaRecepcao':
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
 inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento) where  c.nome like '%" . $_POST['criterio'] . "%' and i.idunidade_escolar not IN(66,164,1,2,67,125,180) order by c.nome");
                    $linha = $candidatos->Linha;
                    $rs = $candidatos->Result;
                }
            }
            break;
            
        case 'consultaPublico':
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
 inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento) where i.idinscricao='" . $_POST['criterio'] . "' and i.idunidade_escolar=" . $_SESSION['idunidade_escolar'] . " and i.idunidade_escolar not IN(66,164,1,2,67,125,180)");
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
 inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento) where i.idunidade_escolar=" . $_SESSION['idunidade_escolar'] . " and i.idunidade_escolar not IN(66,164,1,2,67,125,180) and c.nome like '%" . $_POST['criterio'] . "%' order by c.nome");
                    $linha = $candidatos->Linha;
                    $rs = $candidatos->Result;
                }
            }
            break;

        case 'editar':

            /* Atributos Globais */
            $util = new Util();
            $candidatos = new Candidatos();
            $ocorrencias = new Ocorrencias();
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $linha4;
            global $rs4;


            $candidatos->consultar("select *, date_format(nascimento, '%d/%m/%Y') as dtnasc,  date_format(i.dtreg, '%d/%m/%Y %H:%i:%s') as dtinscricao from candidatos c inner join inscricao i ON(c.idcandidatos = i.idcandidatos) 
 inner join usuarios u ON(i.idusuarios = u.idusuarios) inner join rendafamiliar rf on(c.idrendafamiliar =rf.idrendafamiliar) 
 inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
 inner join tipoinscricao ti ON(i.idtipoinscricao = ti.idtipoinscricao) 
 inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento) where i.idinscricao=" . $_GET['id']);
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;

            $candidatos->consultar("select * from tiposegmento");
            $linha2 = $candidatos->Linha;
            $rs2 = $candidatos->Result;

            $candidatos->consultar("select * from rendafamiliar");
            $linha3 = $candidatos->Linha;
            $rs3 = $candidatos->Result;


            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Incluir

                    $candidatos->consultar("BEGIN");
                    if ($_POST['auditiva'] == 'on') {
                        $auditiva = 'AUDITIVA';
                    }
                    if ($_POST['visual'] == 'on') {
                        $visual = 'VISUAL';
                    }
                    if ($_POST['motora'] == 'on') {
                        $motora = 'MOTORA';
                    }
                    if ($_POST['mental'] == 'on') {
                        $intelectual = 'MENTAL';
                    }
                    if ($_POST['multipla'] == 'on') {
                        $multipla = 'INTELECTUAL';
                    }

                    $idcandidatos = $candidatos->alterar($_GET['id'], $_POST['nome'], $_POST['pai'], $_POST['mae'], $util->formatoDataYMD($_POST['nascimento']), $_POST['sexo'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['uf'], $_POST['cep'], $_POST['telefone'], $_POST['celular'], $_POST['idrendafamiliar'], $_POST['num_irmaos'], $_POST['responsavel'], $_POST['cpf'], $_POST['rg'], $_POST['email'], $auditiva, $visual, $motora, $intelectual,$transtorno_global, $_POST['deficiencias_outras'], $_POST['idade'], $_SESSION['idusuarios'], $_POST['idsegmento_escolar'], $_POST['idtipoinscricao'],$_POST['idunidade_escolar'], $_POST['idunidade_escolar2'],$_POST['idunidade_escolar3'],$_POST['idunidade_escolar4'],$_POST['idunidade_escolar5'],$_POST['camisa_aluno'],$_POST['bermuda_aluno'],$_POST['pe_aluno']);

                    $descricao = "Realizado Cadastro do Candidato <b>" . $_POST['nome'] . "</b> pelo usuário <b>" . $_SESSION['login'] . "</b>";
                    $funcionalidade = "Cadastro de novo candidato";
                    $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));

                    $candidatos->consultar("select * from tiposegmento");
                    $linha = $candidatos->Linha;
                    $rs = $candidatos->Result;

                    $candidatos->consultar("COMMIT");
                    echo"<script>window.open('view/candidatos/ficha.php?&id=" . $idcandidatos . "');</script>";
                    $util->MsgboxSimNaoNovoCad("Registro salvo com sucesso! Deseja Cadastrar um novo Candidato?", 'default.php?pg=view/candidatos/incluir.php&form=Consulta de Candidatos', 'default.php?pg=view/ocorrencias/ocorrencias.php&form=Ocorr&ecirc;ncias que merecem aten&ccedil;&atilde;o');
                } catch (Exception $ex) {
                    $candidatos->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        /* incluir */
        case 'incluirPublico':

            /* Atributos Globais */
            $util = new Util();
            $candidatos = new Candidatos();
            $ocorrencias = new Ocorrencias();
            $vagas = new Vagas();
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $linha4;
            global $rs4;
            $idtipoinscricao = base64_decode($_GET['ti']);

            if ($_SESSION['idperfil'] == 7) {
                $login = $_SESSION['login'];
            } else {
                $login = $_POST['cpf'];
            }
            if ($idtipoinscricao == 1) {
                $candidatos->consultar("select * from tiposegmento where idtipo_segmento=1 or idtipo_segmento=2 or idtipo_segmento=4");
                $linha2 = $candidatos->Linha;
                $rs2 = $candidatos->Result;
            } elseif ($idtipoinscricao == 2) {
                $candidatos->consultar("select * from tiposegmento where idtipo_segmento=1 or idtipo_segmento=2");
                $linha2 = $candidatos->Linha;
                $rs2 = $candidatos->Result;
            }

            $candidatos->consultar("select * from rendafamiliar");
            $linha3 = $candidatos->Linha;
            $rs3 = $candidatos->Result;

            $candidatos->consultar("select * from unidade_escolar where idunidade_escolar <>137 order by descricao");
            $linha4 = $candidatos->Linha;
            $rs4 = $candidatos->Result;

            if ($_POST['auditiva'] == 'on') {
                $auditiva = 'AUDITIVA';
            }
            if ($_POST['visual'] == 'on') {
                $visual = 'VISUAL';
            }
            if ($_POST['motora'] == 'on') {
                $motora = 'MOTORA';
            }
            if ($_POST['intelectual'] == 'on') {
                $intelectual = 'INTELECTUAL';
            }
            if ($_POST['multipla'] == 'on') {
                $multipla = 'MULTIPLA';
            }


            if ($_POST['ok'] == 'true') {
                try {
                    if ($idtipoinscricao == 1) {
                        $candidatos->consultar("BEGIN");
                        //Chamar Incluir
                        $idcandidatos = $candidatos->incluir($idtipoinscricao, $_POST['nome'], $_POST['pai'], $_POST['mae'], $util->formatoDataYMD($_POST['nascimento']), $_POST['sexo'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['uf'], $_POST['cep'], $_POST['telefone'], $_POST['celular'], $_POST['idrendafamiliar'], $_POST['responsavel'], $_POST['cpf'], $_POST['rg'], $_POST['email'], $auditiva, $visual, $motora, $intelectual, $multipla,$transtorno_global, $_POST['deficiencias_outras'],$_POST['idade'], $_SESSION['idusuarios'], $_POST['idsegmento_escolar'], $_POST['idunidade_escolar'], $_POST['idunidade_escolar2'],$_POST['idunidade_escolar3'],$_POST['idunidade_escolar4'],$_POST['idunidade_escolar5'],$_POST['camisa_aluno'],$_POST['bermuda_aluno'],$_POST['pe_aluno']);
                       
					   $descricao = "Realizado Cadastro do Candidato <b>" . $_POST['nome'] . "</b> pelo usuário <b>" . $_SESSION['login'] . "</b>";
                        $funcionalidade = "Cadastro de novo candidato";
                        $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));

                        $candidatos->consultar("COMMIT");
                        $pg = "view/candidatos/ficha.php?&id=" . $idcandidatos;
                        //$pg= base64_encode($pg);
                        echo"<script>window.open('" . $pg . "');</script>";
                        $pg = 'default.php?pg=' . base64_encode("view/publico/incluir.php") . '&form=' . base64_encode("Painel") . '&ti=' . $_GET['ti'];

                        $pg2 = 'default.php?pg=' . base64_encode("view/publico/incluir.php") . '&form=' . base64_encode("Painel");

                        $util->MsgboxSimNaoNovoCad("Registro salvo com sucesso! Deseja Cadastrar um novo Candidato?", $pg, $pg2);
                    }
                    $vagas->verificarVagas($_POST['idunidade_escolar'], $_POST['idunidade_escolar2'],$_POST['idunidade_escolar3'],$_POST['idunidade_escolar4'],$_POST['idunidade_escolar5'], $_POST['idsegmento_escolar']);

                    if ($idtipoinscricao == 2 && $vagas->Achou == 'sim') {
                        $candidatos->consultar("BEGIN");
                        //Chamar Incluir  
                        $idcandidatos = $candidatos->incluir($_POST['nome'], $_POST['pai'], $_POST['mae'], $util->formatoDataYMD($_POST['nascimento']), $_POST['sexo'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['uf'], $_POST['cep'], $_POST['telefone'], $_POST['celular'], $_POST['idrendafamiliar'], $_POST['responsavel'], $_POST['cpf'], $_POST['rg'], $_POST['email'], $auditiva, $visual, $motora, $intelectual, $multipla,$transtorno_global, $_POST['deficiencias_outras'], $_POST['idade'], $_SESSION['idusuarios'], $_POST['idsegmento_escolar'], $idtipoinscricao, $_POST['idunidade_escolar'], $_POST['idunidade_escolar2'],$_POST['idunidade_escolar3'],$_POST['idunidade_escolar4'],$_POST['idunidade_escolar5'],$_POST['camisa_aluno'],$_POST['bermuda_aluno'],$_POST['pe_aluno']);
                        $descricao = "Realizado Cadastro do Candidato <b>" . $_POST['nome'] . "</b> pelo usuário <b>" . $_SESSION['login'] . "</b>";
                        $funcionalidade = "Cadastro de novo candidato";
                        $ocorrencias->Incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade));
                        $vagas->atualizaQuadroVagas($_POST['idunidade_escolar'], $_POST['idunidade_escolar2'],$_POST['idunidade_escolar3'],$_POST['idunidade_escolar4'],$_POST['idunidade_escolar5'], $_POST['idsegmento_escolar'], 2);

                        $candidatos->consultar("COMMIT");
                        $pg = "view/candidatos/ficha.php?&id=" . $idcandidatos;
                        //$pg= base64_encode($pg);
                        echo"<script>window.open('" . $pg . "');</script>";
                        $pg = 'default.php?pg=' . base64_encode("view/publico/incluir.php") . '&form=' . base64_encode("Painel") . '&ti=' . $_GET['ti'];

                        $pg2 = 'default.php?pg=' . base64_encode("view/publico/incluir.php") . '&form=' . base64_encode("Painel");

                        $util->MsgboxSimNaoNovoCad("Registro salvo com sucesso! Deseja Cadastrar um novo Candidato?", $pg, $pg2);
                    }
                } catch (Exception $ex) {
                    $candidatos->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'atualizaClassificacao2etapa':

            /* Atributos Globais */
            $util = new Util();
            $candidatos = new Candidatos();
            $ocorrencias = new Ocorrencias();
            global $linha;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
          /*  $candidatos->consultar("select ue.idunidade_escolar,se.idsegmento_escolar
  from inscricao i inner join candidatos c on(i.idcandidatos = c.idcandidatos) 
 inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar)
inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
where i.fase='SEGUNDA' and i.idsegmento_escolar in(2,3,4,5,7,8,9,10,11,12,13,14) 
group by ue.idunidade_escolar,se.idsegmento_escolar order by ue.idunidade_escolar,se.idsegmento_escolar;");
            */
            $candidatos->consultar("select ue.idunidade_escolar,se.idsegmento_escolar
  from inscricao i inner join candidatos c on(i.idcandidatos = c.idcandidatos) 
 inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar)
inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
where  i.idsegmento_escolar in(1,6) 
group by ue.idunidade_escolar,se.idsegmento_escolar order by ue.idunidade_escolar,se.idsegmento_escolar;");
            $linha = $candidatos->Linha;
            $rs = $candidatos->Result;

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar Incluir
                    $candidatos->consultar("BEGIN");

                    for ($i = 0; $i < $linha; $i++) {
                        $idsegmento_escolar = mysql_result($rs, $i, 'se.idsegmento_escolar');
                        $idunidade_escolar = mysql_result($rs, $i, 'ue.idunidade_escolar');

                        $sql = "select i.classificacao, i.idinscricao,c.nome, c.telefone, c.celular as Celular, 
 ue.descricao as unidade_escolar, se.descricao
  from inscricao i inner join candidatos c on(i.idcandidatos = c.idcandidatos) 
 inner join unidade_escolar ue on(i.idunidade_escolar = ue.idunidade_escolar)
inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
where  i.idsegmento_escolar=" . $idsegmento_escolar . " and i.idunidade_escolar=" . $idunidade_escolar . " order by ue.descricao, se.descricao, i.dtreg desc;";

                        $candidatos->consultar($sql);
                        $linha2 = $candidatos->Linha;
                        $rs2 = $candidatos->Result;
                        $cont = 1;
                        if ($linha2 > 0) {
                            for ($x =0; $x < $linha2; $x++) {
                                $idinscricao = mysql_result($rs2, $x, 'i.idinscricao');
                                $classificacao = $cont;
                                $candidatos->atualizaClassificacao($classificacao, $idinscricao);
                                $cont++;
                            }
                        }
                    }
                    //exit;
                    $candidatos->consultar("COMMIT");

                    $pg = 'default.php?pg=' . base64_encode("view/candidatos/incluir.php") . '&form=' . base64_encode("Pr&eacute;-inscri&ccedil;&atilde;o de Candidato") . '&ti=' . $_GET['ti'];
                    $pg2 = 'default.php?pg=' . base64_encode("view/ocorrencias/ocorrencias.php") . '&form=' . base64_encode("Ocorr&ecirc;ncias que merecem aten&ccedil;&atilde;o");

                    $util->MsgboxSimNaoNovoCad("Registro salvo com sucesso! Deseja Cadastrar um novo Candidato?", $pg, $pg2);
                } catch (Exception $ex) {
                    $candidatos->consultar("ROLLBACK");
                    $util->msgbox("Falha de operacao");
                }
            }
            break;

        case 'consulta':
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
                        echo"<script>window.open('view/candidatos/ficha.php?&id=" . $idcandidatos . "');</script>";
                    }
                }

                if ($_POST['tipo'] == 'nome') {
                    $candidatos->consultar("select *, date_format(nascimento, '%d/%m/%Y') as dtnasc,  date_format(i.dtreg, '%d/%m/%Y %H:%i:%s') as dtinscricao from candidatos c inner join inscricao i ON(c.idcandidatos = i.idcandidatos) 
 inner join usuarios u ON(i.idusuarios = u.idusuarios) inner join rendafamiliar rf on(c.idrendafamiliar =rf.idrendafamiliar) 
 inner join segmentoescolar se on(i.idsegmento_escolar = se.idsegmento_escolar) 
 inner join tipoinscricao ti ON(i.idtipoinscricao = ti.idtipoinscricao) 
 inner join tiposegmento ts on(ts.idtipo_segmento = se.idtipo_segmento) where  c.nome like '%" . $_POST['criterio'] . "%' order by c.nome");
                    $linha = $candidatos->Linha;
                    $rs = $candidatos->Result;
                }
            }
            break;
    }
}

?>