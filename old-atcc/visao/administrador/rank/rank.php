<h2 class="sub-header">Usuários</h2>
<a href="default.php?pg=visao/administrador/cadastro.usuario.php">Cadastrar Usuario</a>
<h2 class="sub-header"></h2>

    
     
		<div class="table-responsive">
           <div id="divConteudo">
		<table class="table table-striped" id="tabela">
			<thead>
				<tr>
					 
                  <th>Identificação</th>
                  <th>Matricula</th>
                  <th>Nome</th>
				  <th>Perfil</th>
                  <th>Situação</th>
                  <th>Data de nascimento</th>
                  <th>CPF</th>
				  <th>RG</th>
				  <th>Endereço</th>
				  <th>Telefone</th>
				  <th>Email</th>
				  <th>Login</th>
				  <th>Senha</th>
                
					
				</tr>
				<tr>
					<th><input type="text" id="txtColuna1"/></th>
					<th><input type="text" id="txtColuna2"/></th>
					<th><input type="text" id="txtColuna3"/></th>
                    <th><input type="text" id="txtColuna4"/></th>
                    <th><input type="text" id="txtColuna5"/></th>
                    <th><input type="text" id="txtColuna6"/></th>
                    <th><input type="text" id="txtColuna7"/></th>
                    <th><input type="text" id="txtColuna8"/></th>
                    <th><input type="text" id="txtColuna9"/></th>
                    <th><input type="text" id="txtColuna10"/></th>
                    <th><input type="text" id="txtColuna11"/></th>
                    <th><input type="text" id="txtColuna12"/></th>
                    <th><input type="text" id="txtColuna13"/></th>
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
                        <td>
                            <?php echo $campo['login']; // mostrando o campo DESCRICAO da tabela ?>
                        </td>
						<td>
                            <?php echo $campo['senha']; // mostrando o campo NOME da tabela ?>
                        </td>
                        <td>
                            <a href="default.php?pg=visao/administrador/cadastro.usuario.php<?php echo $campo['id']; //pega o campo ID para a ediçao ?>">
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
    </body>
</html>
