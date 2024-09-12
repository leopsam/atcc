<h2 class="sub-header">Temas</h2>
    <div class="table-responsive">
           <div id="divConteudo">
		<table class="table table-striped" id="tabela">
			<thead>
				<tr>
					 
                  <th>Identificação</th>
                  <th>Tema</th>
                  <th>Descrição</th>
					
				</tr>
				<tr>
					<th><input type="text" id="txtColuna1"/></th>
					<th><input type="text" id="txtColuna2"/></th>
					<th><input type="text" id="txtColuna3"/></th>
                    
				</tr>				
			</thead>
			<tbody>
            
          
               
				
            </thead>
            <tbody>
                <?php
                    $consulta = mysql_query("SELECT * FROM temas"); // query que busca todos os dados da tabela PRODUTO
                    while($campo = mysql_fetch_array($consulta)){ // laço de repetiçao que vai trazer todos os resultados da consulta
                ?>
                
                <div style="page-break-after: always">
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
						
                        <td>
                <a href="default.php?pg=visao/administrador/temas/alterar.temas.php&id_tema=<?php echo $campo['id_tema'];?>">
                                Editar
                            </a>
                        </td>
                        
                         
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        </div>
        </div>
      