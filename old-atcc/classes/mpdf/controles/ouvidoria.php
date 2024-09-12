<?php

session_start();

require("classes/ouvidoria.php");
require("classes/itemprotocolo.php");
require_once("classes/util.php");

function Processo($Processo) {

    switch ($Processo) {

        case 'incluir':
            //ini_set("memory_limit","64M");
            $util = new Util();
            //$util->Seguranca($_SESSION['id'], '../index.php');
            $Ouvidoria = new Ouvidoria();

            global $resultado;
            global $linhaConsulta;
            global $rs;
            global $linha;
            global $rs1;
            global $linhaRegistroApartamento;
            global $rsApart;
            global $lnprot;
            global $rsprot;
            global $protocolo;
            
            $protocolo = $util->codigoRadomico();

            $Ouvidoria->Consultar("select * from classificacao order by descricao");
            $linhaConsulta = $Ouvidoria->Linha;
            $rs = $Ouvidoria->Result;

            $Ouvidoria->Consultar("select * from baseconhecimentos order by descricao");
            $linha = $Ouvidoria->Linha;
            $rs1 = $Ouvidoria->Result;

            //"C:/wamp/www/Reserva/restrito2/fotos/" 
            $caminho_imagem = "/home/fcaxias/public_html/sysduque/fotos_arquivos_ouvidoria/" . $_SESSION['fototemp'];
            //$_SERVER['HTTP_HOST']."pilates/sistema/";
            @copy("/home/fcaxias/public_html/sysduque/temp/" . $_SESSION['fototemp'], $caminho_imagem);
            
            @unlink("/home/fcaxias/public_html/sysduque/temp/" . $_SESSION['fototemp']);
            // unlink("C:/wamp/www/Reserva/restrito2/temp/".$_SESSION['foto1']);   

            $foto = "../restrito3/fotos_arquivos_ouvidoria/" . $_SESSION['fototemp'];


            if ($_POST['ok'] == 'true') {

                if ($_POST['classificacao'] == '') {
                    $util->msgbox("O campo classificacao e obrigatorio");
                    break;
                }
                if ($_POST['baseconhecimentos'] == '') {
                    $util->msgbox("O campo categoria e obrigatorio");
                    break;
                }
                if ($_POST['assunto'] == '') {
                    $util->msgbox("O campo assunto e obrigatorio");
                    break;
                }
                if ($_POST['observacao'] == '') {
                    $util->msgbox("O campo observacao e obrigatorio");
                    break;
                }
                if ($_SESSION['captcha'] <> $_POST['captcha']) {
                    $util->msgbox('CODIGO INVALIDO');
                    $util->redirecionamentopage('cadastro_ouvidoria.php');
                }

                //DISPARDO DE EMAIL 
                $sql = "SELECT email FROM baseconhecimentos WHERE idbaseconhecimentos = '" . $_POST['baseconhecimentos'] . "'";
                $query = mysql_query($sql);
                $resEmail = mysql_fetch_array($query);

                function enviaMail($assunto, $msg, $recebedor) {

                    $headers = "From: gerenteconcierge@reservajardimrj.com.br\n";
                    $headers .= "Return-Path: gerenteconcierge@reservajardimrj.com.br\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-type: text/html;charset=iso-8859-1\n";
                    $headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal 

                    if (!mail($recebedor, $assunto, $msg, $headers)) {
                        return false;
                    } else {
                        return true;
                    }
                }

                $assunto = "MENSAGEM ABERTA NA OUVIDORIA";
                $msg = "
                <h4>MENSAGEM ABERTA NA OUVIDORIA</h4><br />
				Verificar no sistema esse novo chamado.<br /><br />

                atenciosamente,<br />
                Reserva Jardim<br />
                www.reservajardim.com.br ";

                $enviando = enviaMail($assunto, $msg, $resEmail['email']);

                Try {
                    $Ouvidoria->Consultar("BEGIN");
                    $Ouvidoria->Incluir($_SESSION["id"], $_POST['classificacao'], $_POST['baseconhecimentos'], $_POST['protocolo'], $_POST['assunto'], $_POST['observacao'], $foto, "Em aberto", $idapartamentos);
                    $Ouvidoria->Consultar("COMMIT");
                    $util->msgbox('REGISTRO SALVO COM SUCESSO');
                    $util->MsgboxSimNaoNovoCad('DESEJA INCLUIR OUTRO REGISTRO', 'cadastro_ouvidoria.php');
                } catch (Exception $ex) {
                    $Ouvidoria->Consultar("ROLLBACK");
                    $util->msgbox("Falha " . $ex);
                }
            }
            break;

        case 'editar':


            $util = new Util();

            $Ouvidoria = new Ouvidoria();
            $ItemProtocolo = new ItemProtocolo();

            global $linhaConsulta;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha3;
            global $rs3;
            global $linha;
            global $rs1;
            global $linha4;
            global $rs4;


            $Ouvidoria->Consultar("select * from classificacao");
            $linha2 = $Ouvidoria->Linha;
            $rs2 = $Ouvidoria->Result;

            $Ouvidoria->Consultar("select * from baseconhecimentos");
            $linha = $Ouvidoria->Linha;
            $rs1 = $Ouvidoria->Result;


            if ($_SESSION['idperfil'] == 1 || $_SESSION['idperfil'] == 2 || $_SESSION['idperfil'] == 15 || $_SESSION['idperfil'] == 4 || $_SESSION['idperfil'] == 10 || $_SESSION['idperfil'] == 6 || $_SESSION['idperfil'] == 7 || $_SESSION['idperfil'] == 5 || $_SESSION['idperfil'] == 8 || $_SESSION['idperfil'] == 9) {
                $Ouvidoria->Consultar("select *, DATE_FORMAT(ouv.dtreg, '%Y/%m/%d %H:%i:%s') as data_hora from ouvidoria ouv inner join usuarios u on(ouv.idusuarios=u.id)  where ouv.idouvidoria =" . $_GET['id']);
            } else {
                $Ouvidoria->Consultar("select *, DATE_FORMAT(ouv.dtreg, '%Y/%m/%d %H:%i:%s') as data_hora from ouvidoria ouv inner join usuarios u on(ouv.idusuarios=u.id) inner join morador m on(m.idusuarios=u.id) inner join apartamentos a on(m.idapartamentos=a.idapartamentos) inner join edificios e on(e.idedificios=a.idedificios) where ouv.idouvidoria=" . $_GET['id']);
            }

            $linhaConsulta = $Ouvidoria->Linha;
            $rs = $Ouvidoria->Result;

            @$protocolo = mysql_result($rs, 0, 'protocolo');

            @$idapartamentos = mysql_result($rs, 0, 'idapartamentos');

            if ($idapartamentos == "0") {
                // NAO FAZ NADA
            } else {
                @$Ouvidoria->Consultar("select a.descricao As apartamento, e.descricao As edificio from apartamentos a left join edificios e ON(a.idedificios=e.idedificios) WHERE a.idapartamentos = '" . $idapartamentos . "'");
                $linha4 = $Ouvidoria->Linha;
                $rs4 = $Ouvidoria->Result;
            }

            @$Ouvidoria->Consultar("select *, DATE_FORMAT(ip.dtreg, '%Y/%m/%d %H:%i:%s') as data_hora from itemprotocolo ip inner join 
             ouvidoria ouv on(ip.protocolo=ouv.protocolo) inner join usuarios u 
             on(u.id=ip.idusuarios) inner join perfil p on(u.idperfil=p.idperfil) where ip.protocolo='" . $protocolo . "' group by ip.iditemprotocolo");

            @$linha3 = $Ouvidoria->Linha;
            @$rs3 = $Ouvidoria->Result;

            $protocolo = mysql_result($rs, 0, 'ouv.protocolo');
            $assunto = mysql_result($rs, 0, 'ouv.assunto');
            $classificacao = mysql_result($rs, 0, 'ouv.idclassificacao');
            $observacao = mysql_result($rs, 0, 'ouv.observacao');
            $foto = mysql_result($rs, 0, 'ouv.foto');

            if ($_POST['ok'] == 'true') {
                //Para sustentar o value na visão
                if ($_SESSION['fototemp'] != '') {
                    $foto = $_SESSION['fototemp'];
                    $foto = "../restrito3/fotos/" . $foto;
                }
                if ($_SESSION['fototemp'] == '') {
                    $foto = @mysql_result($rs, 0, 'm.foto');
                }
                //"C:/wamp/www/Reserva/restrito2/fotos/" 
                $caminho_imagem = " /home/fcaxias/public_html/sysduque/fotos/" . $_SESSION['fototemp'];
                //$_SERVER['HTTP_HOST']."pilates/sistema/";
                @copy(" /home/fcaxias/public_html/sysduque/temp/" . $_SESSION['fototemp'], $caminho_imagem);

                @unlink(" /home/fcaxias/public_html/sysduque/temp/" . $_SESSION['fototemp']);
                // unlink("C:/wamp/www/Reserva/restrito2/temp/".$_SESSION['foto1']);   
                if ($_SESSION['idperfil'] == 1) {

                    $caminho = '../restrito2/consulta_ouvidoria.php';
                }
                if ($_SESSION['idperfil'] == 2) {

                    $caminho = '../restrito2/consulta_ouvidoria.php';
                }
                if ($_SESSION['idperfil'] == 3) {

                    $caminho = '../restrito3/consulta_ouvidoria.php';
                }
                if ($_SESSION['idperfil'] == 4) {

                    $caminho = '../restrito4/consulta_ouvidoria.php';
                }

                //DISPARDO DE EMAIL 
                $sql = "SELECT email FROM baseconhecimentos WHERE idbaseconhecimentos = '" . $_POST['baseconhecimentos'] . "'";
                $query = mysql_query($sql);
                $resEmail = mysql_fetch_array($query);

                function enviaMail($assunto, $msg, $recebedor) {

                    $headers = "From: gerenteconcierge@reservajardimrj.com.br\n";
                    $headers .= "Return-Path: gerenteconcierge@reservajardimrj.com.br\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-type: text/html;charset=iso-8859-1\n";
                    $headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal 

                    if (!mail($recebedor, $assunto, $msg, $headers)) {
                        return false;
                    } else {
                        return true;
                    }
                }

                $assunto = "MENSAGEM DE RESPOSTA NA OUVIDORIA";
                $msg = "
                <h4>RESPOSTA A MENSAGEM NA OUVIDORIA</h4><br />
                Verificar no sistema esse novo chamado.<br /><br />

                atenciosamente,<br />
                Reserva Jardim<br />
                www.reservajardim.com.br ";

                $enviando = enviaMail($assunto, $msg, $resEmail['email']);

                try {
                    $Ouvidoria->Consultar("BEGIN");

                    $Ouvidoria->Alterar($_GET['id'], $classificacao, $_POST['baseconhecimentos'], $protocolo, $assunto, $observacao, $foto);
                    $ItemProtocolo->Incluir($_SESSION["id"], $protocolo, $_POST['resposta']);
                    $Ouvidoria->Consultar("COMMIT");
                    $util->MsgboxSimNaoNovoCad('REGISTRO EDITADO COM SUCESSO', $caminho);
                } catch (Exception $ex) {
                    $Ouvidoria->Consultar("ROLLBACK");
                    $util->msgbox("Falha " . $ex);
                }
            }

            if ($_POST['ok'] == 'fecharprotocolo') { //Em Aberto, Finalizado e Cancelado
                try {
                    $Ouvidoria->Consultar("BEGIN");
                    $Ouvidoria->AtulizarSituacaoProtocolo($_GET['id'], "Finalizado");
                    $Ouvidoria->Consultar("COMMIT");
                    $util->msgbox('O protocolo foi finalizado');
                    $util->redirecionamentopage('../restrito2/consulta_ouvidoria.php');
                } catch (Exception $ex) {
                    $Ouvidoria->Consultar("ROLLBACK");
                    $util->msgbox("Falha " . $ex);
                }
            }

            if ($_POST['ok'] == 'cancelarprotocolo') {

                try {
                    $Ouvidoria->Consultar("BEGIN");
                    $Ouvidoria->AtulizarSituacaoProtocolo($_GET['id'], "Cancelado");
                    $Ouvidoria->Consultar("COMMIT");

                    $util->msgbox('O protocolo foi cancelado');
                    $util->redirecionamentopage('../restrito2/consulta_ouvidoria.php');
                } catch (Exception $ex) {
                    $Ouvidoria->Consultar("ROLLBACK");
                    $util->msgbox("Falha " . $ex);
                }
            }

            break;



        case 'consultar_new':

            $util = new Util();
            $Ouvidoria = new Ouvidoria();

            global $lnApt;
            global $rsApt;

            $Ouvidoria->Consultar("select * from edificios order by descricao");
            $lnApt = $Ouvidoria->Linha;
            $rsApt = $Ouvidoria->Result;


            if ($_POST['ok'] == '0') {

                if ($_SESSION['idperfil'] == 3) {

                    $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    where usuarios.id =" . $_SESSION['id'] . " AND classificacao.descricao  LIKE '%" . $_POST['criterio'] . "%' 
                                    ORDER BY ouvidoria.dtreg DESC");

                    $linhaPesq = $Ouvidoria->Linha;
                    $rsPesq = $Ouvidoria->Result;
                }

                if ($_SESSION['idperfil'] == 1) {
                    global $linhaPesq;
                    global $rsPesq;

                    $data_inicio = $util->formatoDataYMD($_POST['data_inicio']);
                    $data_fim = $util->formatoDataYMD($_POST['data_fim']);

                    if ($_POST['filtro_criterio'] == 'periodo') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.situacao = '" . $_POST['situacao2'] . "' AND (date(ouvidoria.dtreg) >= '" . $data_inicio . "' && date(ouvidoria.dtreg) <= '" . $data_fim . "') 
                                   ORDER BY ouvidoria.dtreg DESC");
                    }

                    if ($_POST['filtro_criterio'] == 'blocoApto') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.idapartamentos = '" . $_POST['idapartamentos'] . "' AND
                                    ouvidoria.situacao = '" . $_POST['situacao1'] . "'
                                    ORDER BY ouvidoria.dtreg DESC");
                    }
                    if ($_POST['filtro_criterio'] == 'protocolo') {

                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.protocolo = '" . $_POST['nProtocolo'] . "'
                                    ORDER BY ouvidoria.dtreg DESC");
                    }

//              $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
//                                    classificacao.descricao AS descricao FROM 
//                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
//                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
//                                    WHERE classificacao.descricao LIKE '%".$_POST['criterio']."%' 
//                                    ORDER BY ouvidoria.dtreg DESC");


                    $linhaPesq = $Ouvidoria->Linha;
                    $rsPesq = $Ouvidoria->Result;
                }

                if ($_SESSION['idperfil'] == 7 || $_SESSION['idperfil'] == 5) {

                    if ($_SESSION['idperfil'] == 7) {
                        //CORD DE MANUTENCAO EXIBIR MANUTENCAO 7
                        $baseconhecimento = "1";
                    }

                    if ($_SESSION['idperfil'] == 5) {
                        //ASSISTENTE I EXIBIR BOLETOS 5
                        $baseconhecimento = "10";
                    }

                    global $linhaPesq;
                    global $rsPesq;

                    $data_inicio = $util->formatoDataYMD($_POST['data_inicio']);
                    $data_fim = $util->formatoDataYMD($_POST['data_fim']);

                    if ($_POST['filtro_criterio'] == 'periodo') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                   situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.situacao = '" . $_POST['situacao2'] . "' AND (date(ouvidoria.dtreg) >= '" . $data_inicio . "' && date(ouvidoria.dtreg) <= '" . $data_fim . "') AND idbaseconhecimentos = '" . $baseconhecimento . "'
                                    ORDER BY ouvidoria.dtreg DESC");
                    }


                    if ($_POST['filtro_criterio'] == 'blocoApto') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.idapartamentos = '" . $_POST['idapartamentos'] . "' AND
                                    ouvidoria.situacao = '" . $_POST['situacao1'] . "' AND idbaseconhecimentos = '" . $baseconhecimento . "'
                                    ORDER BY ouvidoria.dtreg DESC");
                    }
                    if ($_POST['filtro_criterio'] == 'protocolo') {

                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.protocolo = '" . $_POST['nProtocolo'] . "' AND idbaseconhecimentos = '" . $baseconhecimento . "' 
                                    ORDER BY ouvidoria.dtreg DESC");
                    }

                    $linhaPesq = $Ouvidoria->Linha;
                    $rsPesq = $Ouvidoria->Result;
                }

                //SINDICO TODOS OS REGISTROS
                if ($_SESSION['idperfil'] == 4 || $_SESSION['idperfil'] == 6 || $_SESSION['idperfil'] == 10 || $_SESSION['idperfil'] == 15) {
                    // 5 atendimento e 8 administracao 

                    global $linhaPesq;
                    global $rsPesq;

                    $data_inicio = $util->formatoDataYMD($_POST['data_inicio']);
                    $data_fim = $util->formatoDataYMD($_POST['data_fim']);

                    if ($_POST['filtro_criterio'] == 'periodo') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.situacao = '" . $_POST['situacao2'] . "' AND (date(ouvidoria.dtreg) >= '" . $data_inicio . "' && date(ouvidoria.dtreg) <= '" . $data_fim . "') 
                                    ORDER BY ouvidoria.dtreg DESC");
                    }


                    if ($_POST['filtro_criterio'] == 'blocoApto') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.idapartamentos = '" . $_POST['idapartamentos'] . "' AND
                                    ouvidoria.situacao = '" . $_POST['situacao1'] . "'
                                    ORDER BY ouvidoria.dtreg DESC");
                    }
                    if ($_POST['filtro_criterio'] == 'protocolo') {

                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.protocolo = '" . $_POST['nProtocolo'] . "' 
                                    ORDER BY ouvidoria.dtreg DESC");
                    }

                    $linhaPesq = $Ouvidoria->Linha;
                    $rsPesq = $Ouvidoria->Result;
                }

                // cord operacao
                if ($_SESSION['idperfil'] == 8) {
                    // 2 limpeza e 9 lazer

                    global $linhaPesq;
                    global $rsPesq;

                    $data_inicio = $util->formatoDataYMD($_POST['data_inicio']);
                    $data_fim = $util->formatoDataYMD($_POST['data_fim']);

                    if ($_POST['filtro_criterio'] == 'periodo') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.situacao = '" . $_POST['situacao2'] . "' AND (date(ouvidoria.dtreg) >= '" . $data_inicio . "' && date(ouvidoria.dtreg) <= '" . $data_fim . "') AND (idbaseconhecimentos = '2' OR idbaseconhecimentos = '9')
                                    ORDER BY ouvidoria.dtreg DESC");
                    }


                    if ($_POST['filtro_criterio'] == 'blocoApto') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.idapartamentos = '" . $_POST['idapartamentos'] . "' AND
                                    ouvidoria.situacao = '" . $_POST['situacao1'] . "' AND (idbaseconhecimentos = '2' OR idbaseconhecimentos = '9')
                                    ORDER BY ouvidoria.dtreg DESC");
                    }
                    if ($_POST['filtro_criterio'] == 'protocolo') {

                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.protocolo = '" . $_POST['nProtocolo'] . "' AND (idbaseconhecimentos = '2' OR idbaseconhecimentos = '9')
                                    ORDER BY ouvidoria.dtreg DESC");
                    }

                    $linhaPesq = $Ouvidoria->Linha;
                    $rsPesq = $Ouvidoria->Result;
                }
                //supervisor de puc
                if ($_SESSION['idperfil'] == 9) {
                    // 3 esporte e 4 jardinagem

                    global $linhaPesq;
                    global $rsPesq;

                    $data_inicio = $util->formatoDataYMD($_POST['data_inicio']);
                    $data_fim = $util->formatoDataYMD($_POST['data_fim']);

                    if ($_POST['filtro_criterio'] == 'periodo') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.situacao = '" . $_POST['situacao2'] . "' AND (date(ouvidoria.dtreg) >= '" . $data_inicio . "' && date(ouvidoria.dtreg) <= '" . $data_fim . "') AND (idbaseconhecimentos = '3' OR idbaseconhecimentos = '4')
                                    ORDER BY ouvidoria.dtreg DESC");
                    }


                    if ($_POST['filtro_criterio'] == 'blocoApto') {
                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.idapartamentos = '" . $_POST['idapartamentos'] . "' AND
                                    ouvidoria.situacao = '" . $_POST['situacao1'] . "' AND (idbaseconhecimentos = '3' OR idbaseconhecimentos = '4')
                                    ORDER BY ouvidoria.dtreg DESC");
                    }
                    if ($_POST['filtro_criterio'] == 'protocolo') {

                        $Ouvidoria->Consultar("SELECT idouvidoria, protocolo,usuarios.nome AS nome, 
                                    situacao FROM 
                                    ouvidoria inner join usuarios on(ouvidoria.idusuarios = usuarios.id) 
                                    inner join classificacao on(ouvidoria.idclassificacao = classificacao.idclassificacao)
                                    WHERE ouvidoria.protocolo = '" . $_POST['nProtocolo'] . "' AND (idbaseconhecimentos = '3' OR idbaseconhecimentos = '4')
                                    ORDER BY ouvidoria.dtreg DESC");
                    }

                    $linhaPesq = $Ouvidoria->Linha;
                    $rsPesq = $Ouvidoria->Result;
                }
            }
            break;

        case 'visualizar':

            $util = new Util();
            $Ouvidoria = new Ouvidoria();

            global $linhaConsulta;
            global $rs;
            global $linha2;
            global $rs2;
            global $linha;
            global $rs1;


            $Ouvidoria->Consultar("select * from classificacao");
            $linha2 = $Ouvidoria->Linha;
            $rs2 = $Ouvidoria->Result;

            $Ouvidoria->Consultar("select * from baseconhecimentos");
            $linha = $Ouvidoria->Linha;
            $rs1 = $Ouvidoria->Result;

            $Ouvidoria->Consultar("select * from ouvidoria where idouvidoria=" . $_GET['id']);
            $linhaConsulta = $Ouvidoria->Linha;
            $rs = $Ouvidoria->Result;

            break;
    }
}

?>
