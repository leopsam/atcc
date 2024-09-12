
<fieldset id="usuario">
<h2 class="sub-header">Escola um tema</h2>
<?php
  $consulta = mysql_query("SELECT * FROM temas");
  while($campo = mysql_fetch_array($consulta)){ 
?>

<table width="650" class="table table-bordered" id="tabela">
			<tbody>
                <?php
                    $consulta = mysql_query("SELECT * FROM temas"); // query que busca todos os dados da tabela PRODUTO
                    while($campo = mysql_fetch_array($consulta)){ // laço de repetiçao que vai trazer todos os resultados da consulta
                ?>
                
                <div style="page-break-after: always">
                    <tr>
						<td>
                            <p><input type="radio" name="tema" id="<?php echo $campo['nome'];?>"/><label for="tema"><?php echo $campo['nome'];?></label></p>
                            <p><?php echo $campo['descricao']; // mostrando o campo NOME da tabela ?></p>
                        </td>
						
					 </tr>
                <?php } ?>
            </tbody>
        </table>

</div>

<?php } ?>

</fieldset>

                
