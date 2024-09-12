<?php
ob_start();  //inicia o buffer
require_once('../../../controles/relatorio.tema.php');
Processo('emitirtema');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml lang="pt-br" xml:lang="pt-br"">

  <head>
    <meta http-equiv="Content-Type" content="text/html; @charset=utf-8" />
    <link rel="icon" href="icon/atcc.ico">

    <title><?php echo mysql_result($rs,0,'nome'); ?></title>
    	
  </head>

	<body>	
    <h1>A.T.C.C</h1>
<h3>Auxiliador de Trabalho de Conclusão de Curso</h3>
<hr noshade>

<h2 class="sub-header">Cadastro de <?php echo mysql_result($rs,0,'nome'); ?></h2>

	
<table border="3">



<tr>
<td height="35">Identificação:</td>
<td><?php echo mysql_result($rs,0,'id_tema'); ?></td>
</tr>

<tr>
<td height="35">Tema:</td>
<td><?php echo mysql_result($rs,0,'nome'); ?></td>
</tr>
 
<tr>
<td height="35">Descrição:</td>
<td><?php echo mysql_result($rs,0,'descricao'); ?></td>
</tr>

</tr>  
</table>
<hr noshade>
</body>
</html>	
<?php
$html = ob_get_clean();
$html = utf8_encode($html);
define('MPDF_PATH','../../../classes/mpdf/');
include(MPDF_PATH.'mpdf.php');
$mpdf = new mPDF();
$mpdf -> allow_charset_conversion=true;
$mpdf -> charset_in='utf-8';
$mpdf -> WriteHTML($html);
$mpdf -> Output();
exit();
?>

