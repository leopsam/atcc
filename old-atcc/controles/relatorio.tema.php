<?php
 require_once('../../../classes/classe.temas.php');
function Processo($Processo) {


    switch ($Processo) {

        case 'emitirtema':
           
            
            global $linha;
            global $rs;

            $usuarios = new Temas();

            $usuarios->consultar("select * from temas where id_tema=".$_GET['id']);
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            break;
    

 case 'emitirListatema':
           
            
            global $linha;
            global $rs;

            $usuarios = new Temas();

            $usuarios->consultar("select * from temas");
            $linha = $usuarios->Linha;
            $rs = $usuarios->Result;

            break;
    }
}


?>

