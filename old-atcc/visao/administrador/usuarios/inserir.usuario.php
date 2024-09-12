<?php 
require_once('controles/controle.usuarios.php');
Processo('incluir');
?>
<div id="corpocon">
<div id="navbar" class="navbar-collapse collapse">
<form class="navbar-form navbar-left" id="form" name="form" method="post">


<h2 class="sub-header">Cadastro de usuarios</h2>		
<table width="500" height="200" border="0">

<tr>
<td height="35">Matricula:</td>
<td><input type="text" name="matricula" id="matricula" size="20" maxlength="20" title="O campo Matricula é obrigatório" class="form-control" placeholder="Matricula do usuario" value="<?php echo $_POST['matricula']; ?>"/></td>
</tr>


<tr>
<td height="35">Nome:</td>
<td><input type="text" name="nome" size="50" maxlength="70" title="O campo nome é obrigatório" class="form-control" placeholder="Nome Completo" value="<?php echo $_POST['nome']; ?>"/></td>
</tr>

 
<tr>
<td height="35">Perfil:</td>
<td><select type="text" name="perfil" style="COLOR: #848484" title="O campo perfil é obrigatório"class="form-control" value="<?php echo @$_POST['perfil']; ?>">
		<option selected>Selecione</option>
		<option>Professor</option>
		<option>Aluno</option>
        <option>Administrador</option>
	</select>
    
</td>
</tr>
    
<tr>
<td height="35">Situação:</td>
<td><select type="text" name="situacao" style="COLOR: #848484"  title="O campo situação é obrigatório" class="form-control" value="<?php echo @$_POST['situacao']; ?>">
		<option selected>Selecione</option>
		<option>Ativo</option>
		<option>Inativo</option>
        
</select>
</td>
</tr>
    
<tr>
<td height="35">Nascimento:</td>
<td><input type="date" name="data_nascimento" style="COLOR: #848484" title="O campo nascimento é obrigatório" class="form-control" value="<?php echo @$_POST['data_nascimento']; ?>"/></td>
</tr>


<tr>
<td height="35">CPF:</td>
<td><input type="text" name="cpf" id="cpf" size="20" maxlength="11" title="O campo CPF é obrigatório" class="form-control" placeholder="Não insira . / - ," 
value="<?php echo @$_POST['cpf']; ?>"/></td>
</tr>

 
<tr>
<td height="35">RG:</td>
<td><input type="text" name="rg" id="rg" size="20" maxlength="9" title="O campo RG é obrigatório" class="form-control" placeholder="Não insira . / - ," value="<?php echo @$_POST['rg']; ?>"/></td>
</tr>


<tr>
<td height="35">Endereço:</td>
<td><input type="text" name="endereco" id="endereco" size="50" title="O campo endereço é obrigatório" class="form-control" maxlength="70" placeholder="Rua, Avenida, Numero, Bairro, Cidade..." value="<?php echo @$_POST['endereco']; ?>"/></td>
</tr>

  
<tr>
<td height="35">Telefone:</td>
<td><input type="tel" name="telefone" id="telefone" size="15" maxlength="12" title="O campo telefone é obrigatório" class="form-control" placeholder="DDD + numero" value="<?php echo @$_POST['telefone']; ?>"/></td>
</tr>

    
<tr>
<td height="35">Email:</td>
<td><input type="email" name="email" id="email" size="50" maxlength="40" title="O campo email é obrigatório" class="form-control" placeholder="Email valido" value="<?php echo @$_POST['email']; ?>"/></td>
</tr>

  
<tr>
<td height="35">Login:</td>
<td><input type="text" name="login" id="login" size="50" maxlength="40" title="O campo login é obrigatório" class="form-control" placeholder="Login" value="<?php echo @$_POST['login']; ?>"/></td>
</tr>

    
<tr>
<td height="35">Senha:</td>
<td><input type="password" name="senha" id="senha" size="15" maxlength="8" title="O campo senha é obrigatório" class="form-control" placeholder="maximo 8 digitos" value="<?php echo @$_POST['senha']; ?>"/></td>
</tr>


<tr>
<td height="35">Foto:</td>
<td>
<input type="file" name="foto" id="foto" />
</tr>
</div>   
</table>
			
			</br>
			
			
  			 
<input type="button" class="btn btn-default" name="button" id="button" value="Cadastrar" onClick="validar(document.form);" />
<input type="hidden" name="ok" id="ok" />

<a class="btn btn-default" href="default.php?pg=visao/administrador/usuarios/consultar.usuarios.php">Voltar</a>
</form>
</div>
      </div>