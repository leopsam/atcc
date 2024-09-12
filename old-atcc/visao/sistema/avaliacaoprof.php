<?php
	session_start();
    require_once '../../classes/conexao.php';
    
    $con = new Acesso(); // instancia classe de conxao
    $con->Conexao(); // abre conexao com o banco	
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Avaliação professor</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

   

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
	<style>
	p{
	
	position: relative;
	margin:10px
	}
	
	div#tabela{
	position: relative;
	width: 3000px;
	
	left: 0px;
	right:-30px
	}
	
	</style>
  </head>

  <body>
          
	<fieldset>
		
		<div id="tabela">
		<h2 class="sub-header"><p>Avalie os professores abaixo</p></h2>
          <div class="table-responsive">
            <table class="table table-striped">
              


<div="tabela">	

<?php
                    $consulta = mysql_query("SELECT * FROM avaliacao"); // query que busca todos os dados da tabela PRODUTO
                    while($campo = mysql_fetch_array($consulta)){ // laço de repetiçao que vai trazer todos os resultados da consulta
					
                ?>		  
              <tbody>
                <tr>
                
                
                  <td> <p><?php echo $campo['orientador']; // mostrando o campo NOME da tabela ?></p></td>
                  <td><p>Conhecimento do tema:
			<select name= "tperfil" id="iperfil" value="<?php echo @$_POST['resposta']; ?>">
				<option selected>selecionar</option>
				<option>10%</option>
				<option>20%</option>
				<option>30%</option>
				<option>40%</option>
				<option>50%</option>
				<option>60%</option>
				<option>70%</option>
				<option>80%</option>
				<option>90%</option>
				<option>100%</option>
			</select></p></td>
			
			
			<td><p>Clareza:
			<select name= "tperfil" id="iperfil"  value="<?php echo @$_POST['resposta']; ?>">
				<option selected>selecionar</option>
				<option>10%</option>
				<option>20%</option>
				<option>30%</option>
				<option>40%</option>
				<option>50%</option>
				<option>60%</option>
				<option>70%</option>
				<option>80%</option>
				<option>90%</option>
				<option>100%</option>
			</select></p></td>
			
			<td><p>Segurança:
			<select name= "tperfil" id="iperfil"  value="<?php echo @$_POST['resposta']; ?>">
				<option selected>selecionar</option>
				<option>10%</option>
				<option>20%</option>
				<option>30%</option>
				<option>40%</option>
				<option>50%</option>
				<option>60%</option>
				<option>70%</option>
				<option>80%</option>
				<option>90%</option>
				<option>100%</option>
			</select></p></td>
			
			<td><p>Entusiasmo:
			<select name= "tperfil" id="iperfil"  value="<?php echo @$_POST['resposta']; ?>">
				<option selected>selecionar</option>
				<option>10%</option>
				<option>20%</option>
				<option>30%</option>
				<option>40%</option>
				<option>50%</option>
				<option>60%</option>
				<option>70%</option>
				<option>80%</option>
				<option>90%</option>
				<option>100%</option>
			</select></p></td>
			
			<td><p> Importância dos tópicos abordados:
			<select name= "tperfil" id="iperfil"  value="<?php echo @$_POST['resposta']; ?>">
				<option selected>selecionar</option>
				<option>10%</option>
				<option>20%</option>
				<option>30%</option>
				<option>40%</option>
				<option>50%</option>
				<option>60%</option>
				<option>70%</option>
				<option>80%</option>
				<option>90%</option>
				<option>100%</option>
			</select></p></td>
			
			<td><p>Distribuição dos tópicos no tempo:
			<select name= "tperfil" id="iperfil"  value="<?php echo @$_POST['resposta']; ?>">
				<option selected>selecionar</option>
				<option>10%</option>
				<option>20%</option>
				<option>30%</option>
				<option>40%</option>
				<option>50%</option>
				<option>60%</option>
				<option>70%</option>
				<option>80%</option>
				<option>90%</option>
				<option>100%</option>
			</select></p></td>
			
			
			<td><p>Duração da aula:
			<select name= "tperfil" id="iperfil"  value="<?php echo @$_POST['resposta']; ?>">
				<option selected>selecionar</option>
				<option>10%</option>
				<option>20%</option>
				<option>30%</option>
				<option>40%</option>
				<option>50%</option>
				<option>60%</option>
				<option>70%</option>
				<option>80%</option>
				<option>90%</option>
				<option>100%</option>
			</select></p></td>
			
			
			<td><p>Utilização dos recursos audiovisuais:
			<select name= "tperfil" id="iperfil"  value="<?php echo @$_POST['resposta']; ?>">
				<option selected>selecionar</option>
				<option>10%</option>
				<option>20%</option>
				<option>30%</option>
				<option>40%</option>
				<option>50%</option>
				<option>60%</option>
				<option>70%</option>
				<option>80%</option>
				<option>90%</option>
				<option>100%</option>
			</select></p></td>
                </tr>
                
				
				
				<?php } ?>
				
				
				
              </tbody>
            </table>
          </div>
		</div>
	</div>	
		
		
		
              <a href="#" class="btn btn-lg btn-default">Enviar</a>
</fieldset>         



		 </div>

         
         

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>