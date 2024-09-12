<?php 
require_once('controles/controle.usuarios.php');
Processo('incluir');
?>



<div id="corpo">
					<div class="jumbotron">
						
	
	<form>
		
		<fieldset>
<legend>Editar perfil</legend>
				<p>Mudar foto:<input name="foto" id="foto" type="file" value="<?php echo @$_POST['foto']; ?>"></p>
		</br>
			<p>Nome:<input type="text" name="nnome" id="inome" size="50" maxlength="70" placeholder="Nome Completo"/></p>
			<p>Telefone:<input type="tel" name="ntelefone" id="itelefone" size="15" maxlength="12" placeholder="DDD + numero"/></p>
			<p>Email:<input type="email" name="nemail" id="iemail" size="50" maxlength="40" placeholder="Email valido"/></p>
			
		
			
			
			</br></br>
		<legend>Editar senha</legend>	
			<p>Senha:<input type="password" name="nsenha" id="isenha" size="15" maxlength="8" placeholder="maximo 8 digitos"/></p>
			<p>confirmar Senha:<input type="password" name="nsenha" id="isenha" size="15" maxlength="8" placeholder="maximo 8 digitos"/></p>
			
			</br>
			
			<input type="button" name="button" id="button" value="Cadastrar" onClick="validar(document.form);" />
<input type="hidden" name="ok" id="ok" />

			<input type="submit" value="Voltar">
			</fieldset>
		</form>
	
	
	
	
	