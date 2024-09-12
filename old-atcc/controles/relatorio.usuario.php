<?php
 require_once('../../../classes/classe.usuarios.php');
function Processo($Processo) {


    switch ($Processo) {

        case 'emitirUsuario':
           
            
            global $linha;
            global $rs;

            $usuarios = new Usuarios();

            $usuarios->consultar("select * from usuarios where id=".$_GET['id']);
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            break;
    

 case 'emitirListaUsuario':
           
            
            global $linha;
            global $rs;

            $usuarios = new Usuarios();

            $usuarios->consultar("select * from usuarios");
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            break;
    }
}


?>

