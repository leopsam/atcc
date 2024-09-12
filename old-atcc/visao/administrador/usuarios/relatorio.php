<?php
ob_start();  //inicia o buffer
require_once('../../../controles/relatorio.usuario.php');
Processo('emitirListaUsuario');
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
                  <th>Matricula</th>
                  <th>Nome</th>
				  <th>Perfil</th>
                  <th>Situação</th>
                  <th>Data de Nascimento</th>
                  <th>CPF</th>
                  <th>RG</th>
                  <th>Endereço</th>
                  <th>Telefone</th>
                  <th>Email</th>
                 </tr>
                 
			</thead>
            
		<tbody>
        
   <?php
      $consulta = mysql_query("SELECT * FROM usuarios");
      while($campo = mysql_fetch_array($consulta)){ 
                ?>
                
              
                    <tr>
						
                        <td>
                            <?php echo $campo['id']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
						<td>
                            <?php echo $campo['matricula']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
						<td>
                            <?php echo $campo['nome']; // mostrando o campo NOME da tabela ?>
						
                        </td>
                       
						<td>
                            <?php echo $campo['perfil']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
                        <td>
                            <?php echo $campo['situacao']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
                        <td>
                            <?php echo $campo['data_nascimento']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
						<td>
                            <?php echo $campo['cpf']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
                        <td>
                            <?php echo $campo['rg']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
                        <td>
                            <?php echo $campo['endereco']; // mostrando o campo NOME da tabela ?>
                        </td>
                       
                        <td>
                            <?php echo $campo['telefone']; // mostrando o campo NOME da tabela ?>
                        </td>
                        
                        <td>
                            <?php echo $campo['email']; // mostrando o campo NOME da tabela ?>
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
$mpdf = new mPDF('A4-P');
$mpdf -> allow_charset_conversion=true;
$mpdf -> charset_in='UTF-8';
$mpdf -> WriteHTML($html);
$mpdf -> Output();
exit();
?>


