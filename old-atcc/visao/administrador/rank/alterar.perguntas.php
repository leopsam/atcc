<?php
require_once('controles/perguntas.php');
Processo('editar');	
?>


<div id="navbar" class="navbar-collapse collapse">
<form class="navbar-form navbar-left" id="form" name="form" method="post">

<h2 class="sub-header">Cadastro de Perguntas</h2>		
<table width="500" height="300" border="0">


<tr>
<td height="35">Pergunta:</td>
</tr>
<td><textarea type="text" name="descricao"  id="descricao" cols="80" rows="10" class="form-control" value="<?php echo mysql_result($rs,0,'descricao'); ?>"></textarea></td>
</tr>
</table>
			
			</br></br>
			
<input type="button" class="btn btn-default" name="button" value="Editar" onClick="validar(document.form);" />
<input type="hidden" name="ok" id="ok" /> 
<a class="btn btn-default" href="default.php?pg=visao/administrador/rank/consultar.perguntas.php">Voltar</a>

</form>
<script>
document.form.descricao.value='<?php echo mysql_result($rs,0,'descricao'); ?>';
</script>