
				<div id="corpo">
					<div class="jumbotron">
						<div class="container">
							<h1>Bem vindo ao ATCC</h1>
							<p>Este é um sistema que revoluciona o modo de orientar o trabalho de conclusão de curso, onde o aluno e orientador possam se comunicar.</p>
						</div>
					</div>
				</div>
                
					
						
	<div id="tcc">
		
    <div class="table-responsive">
           <div id="divConteudo">
		<table class="table table-striped" id="tabela">
			
            <tbody>
                <?php
                    $consulta = mysql_query("SELECT * FROM tcc"); // query que busca todos os dados da tabela PRODUTO
                    while($campo = mysql_fetch_array($consulta)){ // laço de repetiçao que vai trazer todos os resultados da consulta
                ?>
                
                <div style="page-break-after: always">
                    <tr>
						<td>
                            <?php echo $campo['usuario_1']; // mostrando o campo NOME da tabela ?>//<?php echo $campo['usuario_2']; // mostrando o campo NOME da tabela ?>
                        </td>
						</tr>
						 <tr>
						<td>
                            <?php echo $campo['tema']; // mostrando o campo NOME da tabela ?>
                        </td>
						</tr>
						 <tr>
						<td>
                            <?php echo $campo['orientador']; // mostrando o campo NOME da tabela ?>
						
                        </td>
					 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
		
		