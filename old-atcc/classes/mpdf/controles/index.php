<?php

session_start();

require_once('classes/usuarios.php');
require_once('classes/util.php');

/* Function Processos */
global $Adm_acesso_usuario;

function Processo($Processo) {


    /* Switch processos */
    switch ($Processo) {
        /* login de identificação */
        case 'login':
            /* Atributos Globais */
            $util = new Util();
            $usuarios = new Usuarios();

            /*
              $calendarioletivo->consultar("select * from periodoletivo order by siglaperiodo;");
              $linha=$calendarioletivo->Linha;
              $rs=$calendarioletivo->Result;

              for($i=0;$i<$linha;$i++){
              $data_inicio=mysql_result($rs,$i,'data_inicio');
              $data_fim=mysql_result($rs,$i,'data_fim');
              $calendarioletivo->inserirDataAulaPorPeriodo($data_inicio, $data_fim);
              }
             */
            if ($_POST['ok'] == 'true') {
                $sql = 'select * from usuarios u where u.login="' . ($_POST['login']) . '" and u.senha="' . (base64_encode($_POST['senha'])) . '" and u.situacao="ATIVO"';
                //$sql = str_replace("'", "\'", $sql);
                $usuarios->consultar($sql);
                $rs = $usuarios->Result;
                $linha = $usuarios->Linha;

                if ($linha > 0) {
                    $_SESSION['idusuarios'] = mysql_result($rs, 0, 'u.idusuarios');
                    $_SESSION['idperfil'] = mysql_result($rs, 0, 'u.idperfil');
                    $_SESSION['foto'] = "img/caxias.jpg";

                    /*                    if (mysql_result($rs, 0, 'p.foto') != '') {

                      $_SESSION['foto'] = mysql_result($rs, 0, 'p.foto');
                      } else {
                      $_SESSION['foto'] = "sem_foto.jpg";
                      } */
                    $_SESSION['login'] = mysql_result($rs, 0, 'u.login');
                    $_SESSION['idunidade_escolar'] = mysql_result($rs, 0, 'u.idunidade_escolar');
                    $_SESSION['horalogado'] = "Logado em " . date('H:i');

                    if ($_SESSION['idperfil'] == 1 || $_SESSION['idperfil'] == 3 || $_SESSION['idperfil'] == 4 || $_SESSION['idperfil'] == 5) {
                        $pg = "default.php?pg=" . base64_encode('view/publico/incluir3.php') . "&form=" . base64_encode('Painel');
                    } 
                    
                    if ($_SESSION['idperfil'] == 7) {
                        $pg = "default.php?pg=" . base64_encode('view/publico/incluir.php') . "&form=" . base64_encode('Painel');
                    } 
                    if ($_SESSION['idperfil'] == 6) {
                        $pg = "default.php?pg=" . base64_encode('view/candidatos/consultaRecepcao.php') . "&form=" . base64_encode('Painel');
                    } 
                    if ($_SESSION['idperfil'] == 8) {
                        $pg = "default.php?pg=" . base64_encode('view/publico/incluirDiretores.php') . "&form=" . base64_encode('Painel');
                    } 
                    $util->redirecionamentopage($pg);
                } else {
                    $util->msgbox("Login ou senha errado!");
                }
            }
            break;

        case 'esqueceuSenha':
            /* Atributos Globais */
            require_once('classes/usuarios.php');
            $usuarios = new Usuarios();
            $util = new Util();

            if ($_POST['ok'] == 'true') {
                $sql = "select * from usuarios u inner join perfil on(u.idperfil=perfil.idperfil) where u.email='" . trim($_POST['email']) . "'";
                $usuarios->consultar($sql);
                $rs = $usuarios->Result;
                $linha = $usuarios->Linha;
                if ($linha > 0) {
                    $login = mysql_result($rs, 0, 'u.login');
                    $senha = mysql_result($rs, 0, 'u.senha');
                    $perfil = mysql_result($rs, 0, 'perfil.descricao');

                    $usuarios->EnviarEmail($login, $senha, $_POST['email'], $perfil);
                    $util->MsgboxSimNaoNovoCad("Os dados de autenticação de acesso do Matrícula Sem Fila 2016, foram enviado para o seguinte e-mail :" . $_POST['email'], "index.php", NULL);
                    $util->redirecionamentopage("index.php");
                } else {
                    $util->msgbox("O e-mail informado não foi encontrado, por favor entre em contato com a secretaria!");
                }
            }
            break;
        case 'logoff':
            $util = new Util();
            @session_destroy();
            $util->redirecionamentopage("index.php");

            break;
    }
}

?>