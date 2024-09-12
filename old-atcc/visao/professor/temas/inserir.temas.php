<?php 
require_once('controles/controle.temas.php');
Processo('incluir');
?>


<div id="navbar" class="navbar-collapse collapse">
<form class="navbar-form navbar-left" id="form" name="form" method="post">


<h2 class="sub-header">Cadastro de temas</h2>		
<table width="500" height="300" border="0">


<tr>
<td height="72">Tema:
<input type="text" name="nome" id="nome" size="70" maxlength="20" class="form-control" placeholder="Nome do tema" value="<?php echo @$_POST['nome']; ?>"/></td>
</tr>


<tr>
<td height="33">Descrição: 
<tr> 
<td>
<textarea type="text" name="descricao"  id="descricao" cols="80" rows="10" class="form-control" placeholder="Descrição do tema" value="<?php echo @$_POST['descricao']; ?>"></textarea></td>
</tr>
</div>
</table>
			
			</br></br>
			
			
  			 
<input type="button" name="button" id="button" value="Cadastrar" onClick="validar(document.form);" />
<input type="hidden" name="ok" id="ok" />
</form>