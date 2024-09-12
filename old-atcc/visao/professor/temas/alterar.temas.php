<?php
require_once('controles/controle.temas.php');
Processo('editar');	
?>


<div id="navbar" class="navbar-collapse collapse">
<form class="navbar-form navbar-left" id="form" name="form" method="post">

<h2 class="sub-header">Cadastro de temas</h2>		
<table width="500" height="300" border="0">



<tr>
<td height="72">Tema:
<input type="text" name="nome" id="nome" size="70" maxlength="20" class="form-control"   value="<?php echo mysql_result($rs,0,'nome'); ?>"/></td>
</tr>

<tr>
<td height="35">Descrição:
</tr>
<td><textarea type="text" name="descricao"  id="descricao" cols="80" rows="10" class="form-control" value="<?php echo mysql_result($rs,0,'descricao'); ?>"></textarea></td>
</tr>
</table>
			
			</br></br>
			
<input type="button" name="button" value="Editar" onClick="validar(document.form);" />
<input type="hidden" name="ok" id="ok" /> 
</form>
<script>
document.form.descricao.value='<?php echo mysql_result($rs,0,'descricao'); ?>';
</script>