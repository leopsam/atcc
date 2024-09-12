

<div id="corpocon">

<h2 class="sub-header">Usuários</h2>
    
     
		<div class="table-responsive">
           <div id="divConteudo">
		<table class="table table-bordered" id="tabela">
			<thead>
				<tr>
					 
                 
                  <th>Matricula</th>
                  <th>Nome</th>
				  <th>Perfil</th>
                  <th>Situação</th>
                  <th>CPF</th>
				  
                
					
				</tr>
				<tr>
					<th><input type="text" id="txtColuna1"/></th>
					<th><input type="text" id="txtColuna2"/></th>
					<th><input type="text" id="txtColuna3"/></th>
                    <th><input type="text" id="txtColuna4"/></th>
                    <th><input type="text" id="txtColuna5"/></th>
                  
				</tr>				
			</thead>
			<tbody>
            
          
               
				
            </thead>
            <tbody>
                <?php
                    $consulta = mysql_query("SELECT * FROM usuarios"); // query que busca todos os dados da tabela PRODUTO
                    while($campo = mysql_fetch_array($consulta)){ // laço de repetiçao que vai trazer todos os resultados da consulta
                ?>
                
                <div style="page-break-after: always">
                    <tr>
						
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
                            <?php echo $campo['cpf']; // mostrando o campo NOME da tabela ?>
                        </td>
						
                        <td>
                <a class="btn btn-default" href="default.php?pg=visao/administrador/usuarios/alterar.usuario.php&id=<?php echo $campo['id'];?>">Editar</a>
                 <a class="btn btn-default" href="visao/administrador/usuarios/relatorio.usuario.php?id=<?php echo $campo['id'];?>" target="_blank">Relatorio</a>
                        </td>
                        
                         
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        </div>
        </div>
      </div>