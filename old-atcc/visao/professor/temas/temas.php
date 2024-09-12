<fieldset id="usuario"><h2 class="sub-header">Escola um tema</h2>

<table>
	<tbody>

<?php
  $consulta = mysql_query("SELECT * FROM temas");
  while($campo = mysql_fetch_array($consulta)){ 
?>
     <tr>
		<td>
         <input type="radio" name="n1" id="i1" value="<?php echo @$_POST['nome']; ?>"/>
		 <?php echo $campo['nome']; ?>
         </br>
          <p>Descrição: <?php echo $campo['descricao']; ?> </p>
         </br>
         </br>
        </td>
	 </tr>

     </tbody>
</table>
<?php } ?>       

</br>
			
			<input type="submit" value="Salvar">
			<input type="submit" value="Voltar">
			
</br></br>

</fieldset>

                
