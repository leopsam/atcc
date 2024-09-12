<?php
ob_start();  //inicia o buffer
require_once('../../controles/relatorio.usuario.php');
Processo('emitirListaUsuario');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="306" border="0">
  <tr>
    <td>Nome</td>
    <td>Perfil</td>
  </tr>
  <?php for($i=0;$i<$linha;$i++){?>
  <tr>
    <td><?php echo mysql_result($rs,$i,'nome');?></td>
    <td><?php echo mysql_result($rs,$i,'perfil');?></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>

