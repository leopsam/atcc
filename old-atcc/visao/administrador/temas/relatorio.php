<?php
ob_start();  //inicia o buffer
require_once('../../../controles/relatorio.tema.php');
Processo('emitirListatema');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml lang="pt-br" xml:lang="pt-br"">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="icon/atcc.ico">

    <title>ATCC</title>
	
  </head>
 
<body>
<h1>A.T.C.C</h1>
<h3>Auxiliador de Trabalho de Conclusão de Curso</h3>
<hr noshade>
<table border="3">
			<thead>
				<tr>					 
                  <th>Id</th>
                  <th>Tema</th>
                  <th>Descrição</th>
				  
                 </tr>
                 
			</thead>
            
		<tbody>
        
   <?php
      $consulta = mysql_query("SELECT * FROM temas");
      while($campo = mysql_fetch_array($consulta)){ 
                ?>
                
              
                    <tr>
						
                        <td>
                            <?php echo $campo['id_tema']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
						<td>
                            <?php echo $campo['nome']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
						<td>
                            <?php echo $campo['descricao']; // mostrando o campo NOME da tabela ?>
						
                        </td>
                       
						
                   </tr>
                   
                <?php } ?>
            </tbody>
            
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
$mpdf -> charset_in='UTF-8';
$mpdf -> WriteHTML($html);
$mpdf -> Output();
exit();
?>


