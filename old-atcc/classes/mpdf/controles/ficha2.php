<?php
ob_start();  //inicia o buffer
require_once('../../controles/relatorios.php');
Processo('fichaCandidato');
?>
<style type="text/css">
<!--
.style1 {font-size: 16px}
.style23 {font-size: 18px; font-weight: bold; }
.style24 {font-size: 18px}
.style26 {font-size: 12px; }
-->
</style>
<body>
<center>
  <p align="center"><img src="../../img/caxias.jpg" width="65" height="84" /><br/>
  <strong>ESTADO DO RIO DE JANEIRO </strong><br />
        <strong>PREFEITURA DE DUQUE DE CAXIAS </strong><br />
        <strong>SECRETARIA MUNICIPAL DE EDUCA&Ccedil;&Atilde;O </strong> <br />
  </p>
  <p align="center" class="style1">&nbsp;</p>
  <p align="center" class="style1"><span class="style23"><?php echo $tipo;?> </span></p>
  <br />
<br />
  <table width="1010">
    <tr>
      <td colspan="2" class="style24"><span class="style23"><center><?php echo @mysql_result($rs,0,'i.fase')." ETAPA";?></center></span></td>
    </tr>
    <tr>
      <td class="style24">&nbsp;</td>
      <td class="style23">&nbsp;</td>
    </tr>
    <tr>
      <td width="559" class="style24"><strong>ENSINO &nbsp;: <?php echo @mysql_result($rs,0,'ts.descricao');?></strong></td>
      <td width="439" class="style23">SEGMENTO REQUERIDO: &nbsp;<?php echo @mysql_result($rs,0,'se.descricao');?></td>
    </tr>
	<?php if(@mysql_result($rs,0,'i.classificacao')>0){?>
    <tr>
      <td class="style24"><strong>CLASSIFICA&Ccedil;&Atilde;O &nbsp;: <?php echo @mysql_result($rs,0,'i.classificacao');?></strong></td>
      <td class="style23">SITUA&Ccedil;&Atilde;O: &nbsp;<?php echo $situacao;?></td>
    </tr>
	<?php }?>
  </table>
  <br />
  <div class="style26" style="margin-left:auto"><strong>PROTOCOLO</strong> : <?php echo "000".utf8_decode(@mysql_result($rs,0,'i.idinscricao'));?> | NOME &nbsp;: <?php echo utf8_decode(@mysql_result($rs,0,'c.nome'));?> | <span class="style26" style="margin-left:auto">RG/&Oacute;RG&Atilde;O &nbsp;: <?php echo @mysql_result($rs,0,'c.rg');?>&nbsp;</span></div>
  <br />
  
  <div class="style26" style="margin-left:auto">SEXO &nbsp;: <?php echo @mysql_result($rs,0,'c.sexo');?> &nbsp;| NASCIMENTO&nbsp;: <?php echo @mysql_result($rs,0,'dtnasc');?> &nbsp;| IDADE &nbsp;: <?php echo @mysql_result($rs,0,'c.idade')." anos";?> &nbsp;| PAI &nbsp;: <?php echo utf8_decode(@mysql_result($rs,0,'c.pai'));?></div>
   <br />
  <div class="style26" style="margin-left:auto">M&Atilde;E &nbsp;: <?php echo utf8_decode(@mysql_result($rs,0,'c.mae'));?>&nbsp;| <span class="style26" style="margin-left:auto">ENDERE&Ccedil;O&nbsp;: <?php echo utf8_decode(@mysql_result($rs,0,'c.endereco'));?></span> | N&Uacute;MERO&nbsp;: <?php echo @mysql_result($rs,0,'c.numero');?> | COMPLEMENTO :      <?php echo utf8_decode(@mysql_result($rs,0,'c.complemento'));?> | CEP&nbsp;: <?php echo @mysql_result($rs,0,'c.cep');?></div>
   <br />
  <div class="style26" style="margin-left:auto"> BAIRRO&nbsp;: <?php echo utf8_decode(@mysql_result($rs,0,'c.bairro'));?> | CIDADE&nbsp;: <?php echo utf8_decode(@mysql_result($rs,0,'c.cidade'));?> | UF&nbsp;: <?php echo @mysql_result($rs,0,'c.uf');?></div>
   <br />
  <div class="style26" style="margin-left:auto">TELEFONE &nbsp;: <?php echo @mysql_result($rs,0,'c.telefone');?> | CELULAR &nbsp;: <?php echo @mysql_result($rs,0,'c.celular');?> | E-MAIL : &nbsp;<?php echo @mysql_result($rs,0,'c.email');?></div>
   <br />
   <div class="style26" style="margin-left:auto">RESPONSÁVEL&nbsp;: <?php echo utf8_decode(@mysql_result($rs,0,'c.responsavel'));?> | <span class="style26" style="margin-left:auto">CPF &nbsp;: <?php echo @mysql_result($rs,0,'c.cpf');?> &nbsp;| </span>RENDA &nbsp;: <?php echo @mysql_result($rs,0,'rf.descricao');?></div>
    <br />
	<?php //if((@mysql_result($rs,0,'i.fase')='PRIMEIRA'){?>
	<div class="style26" style="margin-left:auto">UNIDADE ESCOLAR   : &nbsp;<?php echo $unidadeEscolar;?></div>
	<br />
	<?php //}?>
   <div class="style26" style="margin-left:auto">DEFICIÊNCIA : &nbsp;<?php echo @mysql_result($rs,0,'c.auditiva'). "   ".@mysql_result($rs,0,'c.visual'). "   ".@mysql_result($rs,0,'c.motora'). "   ".@mysql_result($rs,0,'c.intelectual'). "   ".@mysql_result($rs,0,'c.multipla')."  ".@mysql_result($rs,0,'c.transtorno_global')."  ".@mysql_result($rs,0,'c.deficiencias_outras');?></div>
  <span class="style26"><br />
  </span>
  <p class="style26">--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
</center>
  <center class="style26">
  <table width="1010" align="center">
    <tr>
      <td colspan="3"><center><div align="center"><strong>DOCUMENTO COMPROBAT&Oacute;RIO DE PR&Eacute;-INSCRI&Ccedil;&Atilde;O PARA 2015 &nbsp;</strong></div></center></td>
    </tr>
    <tr>
      <td width="235"><strong>PROTOCOLO</strong> : <?php echo "000".utf8_decode(@mysql_result($rs,0,'i.idinscricao'));?></td>
      <td width="435"><strong>DATA DE INSCRI&Ccedil;&Atilde;O : <?php echo @mysql_result($rs,0,'dtinscricao');?></strong></td>
      <td width="324"><strong>USU&Aacute;RIO : <?php echo @mysql_result($rs,0,'u.nome');?></strong> </td>
    </tr>
    <tr>
      <td colspan="3" align="center"><br/><br/><div style="margin-left:auto"><strong>(<span class="style23"><?php echo $tipo;?></span>)</strong></div>
        <br/><br/></td>
    </tr>
  </table>
</center>
</body>
<?php 
$html = ob_get_clean();
	// pega o conteudo do buffer, insere na variavel e limpa a mem�ria
	 
	$html = utf8_encode($html);
	// converte o conteudo para uft-8
	
	
	define('MPDF_PATH', '../../classes/mpdf/');
	include(MPDF_PATH.'mpdf.php');
	// inclui a classe
	 
	$mpdf = new mPDF();
	// cria o objeto
	 
	$mpdf->allow_charset_conversion=true;
	// permite a conversao (opcional)
	$mpdf->charset_in='UTF-8';
	// converte todo o PDF para utf-8
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->SetFooter('{DATE j/m/Y  H:i}|{PAGENO}/{nb}| PMDC/SMEDC');
	 
	$mpdf->WriteHTML($html);
	// escreve definitivamente o conteudo no PDF
	 
	$mpdf->Output();
	// imprime
	 
exit();
?> 
