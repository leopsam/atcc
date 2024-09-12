<?php
@session_start();
require('classes/classe.usuarios.php');
require('classes/util.php');

function Processo($Processo) {


    switch ($Processo) {
        
        case 'login':
        
         
        
          
         
         if($_POST['ok']=='true'){
          
             $usuario = new Usuarios();
             $sql="select * from usuarios where login='".$_POST['login']."' and senha='".$_POST['senha']."'";
             $usuario->consultar($sql);
             $linha=$usuario->Linha;
             $rs = $usuario->Result;
			
           
		 
		  $util= new Util();
		  if($linha>0){ 
                    $_SESSION['id']=mysql_result($rs,0,'id');
                    $_SESSION['nome']=mysql_result($rs,0,'nome');
                    $_SESSION['perfil']=mysql_result($rs,0,'perfil');
					$_SESSION['foto']=mysql_result($rs,0,'foto');


                    $util->redirecionamentopage('default.php');  
             }else{
               $util->msgbox('Usuário ou senha não confere!');  
             }
         }
            
        break;    
    }
}
?>
