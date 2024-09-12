<?php 
require_once('controles/perguntas.php');
Processo('incluir');
?>


<div id="navbar" class="navbar-collapse collapse">
<form class="navbar-form navbar-left" id="form" name="form" method="post">


<h2 class="sub-header">Cadastro de Pergunta</h2>		
<table width="500" height="300" border="0">



<tr>
<td height="33">Descrição: 
<tr> 
<td>
<textarea type="text" name="descricao"  id="descricao" cols="80" rows="10"  title="O campo descrição é obrigatório" class="form-control" placeholder="Descrição do tema" value="<?php echo @$_POST['descricao']; ?>"></textarea></td>
</tr>
</div>
</table>
			
			</br></br>
			
			
  			 
<input type="button" class="btn btn-default" name="button" id="button" value="Cadastrar" onClick="validar(document.form);" />
<input type="hidden" name="ok" id="ok" />
<a class="btn btn-default" href="default.php?pg=visao/administrador/rank/consultar.perguntas.php">Voltar</a>
</form>