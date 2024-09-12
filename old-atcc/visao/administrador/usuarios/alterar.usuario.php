<?php
require_once('controles/controle.usuarios.php');
Processo('editar');	
?>

<div id="corpocon">
<div id="navbar" class="navbar-collapse collapse">
<form class="navbar-form navbar-left" id="form" name="form" method="post">

<h2 class="sub-header">Cadastro de usuarios</h2>		
<table width="500" height="200" border="0">



<tr>
<td height="35">Matricula:</td>
<td><input type="text" name="matricula" id="matricula" size="15" maxlength="8" class="form-control"   value="<?php echo mysql_result($rs,0,'matricula'); ?>"/></td>
</tr>

<tr>
<td height="35">Nome:</td>
<td><input type="text" name="nome" id="nome" size="50" maxlength="70" class="form-control" value="<?php echo mysql_result($rs,0,'nome'); ?>"/></td>
</tr>
 
<tr>
<td height="35">Perfil:</td>
<td><select type="text" name="perfil" id="perfil" class="form-control" value="<?php echo mysql_result($rs,0,'perfil'); ?>">
		<option>Professor</option>
		<option>Aluno</option>
        <option>Administrador</option>
	</select>
    
</td>
</tr>
    
<tr>
<td height="35">Situação:</td>
<td><select type="text" name="situacao" id="situacao" class="form-control" value="<?php echo mysql_result($rs,0,'situacao'); ?>">
		<option>Ativo</option>
		<option>Inativo</option>
        
</select>
</td>
</tr>
   
<tr>
<td height="35">Nascimento:</td>
<td><input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="<?php echo mysql_result($rs,0,'data_nascimento'); ?>"/></td>
</tr>

  
<tr>
<td height="35">CPF:</td>
<td><input type="text" name="cpf" id="cpf" size="20" maxlength="11" class="form-control" value="<?php echo mysql_result($rs,0,'cpf'); ?>"/></td>
</tr>

 
<tr>
<td height="35">RG:</td>
<td><input type="text" name="rg" id="rg" size="20" maxlength="9" class="form-control" value="<?php echo mysql_result($rs,0,'rg'); ?>"/></td>
</tr>


<tr>
<td height="35">Endereço:</td>
<td><input type="text" name="endereco" id="endereco" size="50" class="form-control" maxlength="70" value="<?php echo mysql_result($rs,0,'endereco'); ?>"/></td>
</tr>

   
<tr>
<td height="35">Telefone:</td>
<td><input type="tel" name="telefone" id="telefone" size="15" maxlength="12" class="form-control" value="<?php echo mysql_result($rs,0,'telefone'); ?>"/></td>
</tr>

     
<tr>
<td height="35">Email:</td>
<td><input type="email" name="email" id="email" size="50" maxlength="40" class="form-control" value="<?php echo mysql_result($rs,0,'email'); ?>"/></td>
</tr>

  
<tr>
<td height="35">Login:</td>
<td><input type="text" name="login" id="login" size="50" maxlength="40" class="form-control" value="<?php echo mysql_result($rs,0,'login'); ?>"/></td>
</tr>

    
<tr>
<td height="35">Senha:</td>
<td><input type="password" name="senha" id="senha" size="15" maxlength="8" class="form-control" value="<?php echo mysql_result($rs,0,'senha'); ?>"/></td>
</tr>

<tr>
<td height="35">Foto:</td>
<td>
<input type="file" name="foto" id="foto" />
</tr>
</div>   
</table>
			
			</br>
<input type="button" class="btn btn-default" name="button" value="Editar" onClick="validar(document.form);" />
<input type="hidden" name="ok" id="ok" /> 
<a class="btn btn-default" href="default.php?pg=visao/administrador/usuarios/consultar.usuarios.php">Voltar</a>
</form>
  </div> 
<script>
document.form.perfil.value='<?php echo mysql_result($rs,0,'perfil'); ?>';
document.form.situacao.value='<?php echo mysql_result($rs,0,'situacao'); ?>';
</script>  
   
