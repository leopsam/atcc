<div id="corpocon">
<h2 class="sub-header">Perguntas</h2>
    <div class="table-responsive">
           <div id="divConteudo">
		<table width="357" class="table table-bordered" id="tabela">
			<thead>
				<tr>
					 
                  <th width="23%">Identificação</th>
                  <th width="50%">Perguntas</th>
                  
             
					
				</tr>
				<tr>
					<th><input type="text" id="txtColuna1"/></th>
					<th><input type="text" id="txtColuna2"/></th>
					 
				</tr>				
			</thead>
			<tbody>
            
          
               
				
            </thead>
            <tbody>
                <?php
                    $consulta = mysql_query("SELECT * FROM perguntas"); // query que busca todos os dados da tabela PRODUTO
                    while($campo = mysql_fetch_array($consulta)){ // laço de repetiçao que vai trazer todos os resultados da consulta
                ?>
                
                <div style="page-break-after: always">
                    <tr>
						<td>
                            <?php echo $campo['id_pergunta']; // mostrando o campo NOME da tabela ?>
                        </td>
						<td>
                            <?php echo $campo['descricao']; // mostrando o campo NOME da tabela ?>
						
                        </td>
						
                        <td width="27%">
                <a class="btn btn-default" href="default.php?pg=visao/administrador/rank/alterar.perguntas.php&id_pergunta=<?php echo $campo['id_pergunta'];?>">Editar</a>
                
                 <a class="btn btn-default" href="visao/administrador/temas/relatorio.tema.php?id=<?php echo $campo['id_tema'];?>" target="_blank">Relatorio</a>
                        </td>
                        
                         
                    </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>
        </div>
        </div>
        </div>
      