<?php
	session_start();
	
    require_once 'classes/conexao.php';
    
    $con = new Acesso(); // instancia classe de conxao
    $con->Conexao(); // abre conexao com o banco	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml lang="pt-br" xml:lang="pt-br"">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="icon/atcc.ico">

    <title>ATCC Principal</title>
    
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
	<link href="css/jumbotron.css" rel="stylesheet">
	<link href="css/cadastro.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/etapa.css" rel="stylesheet">    
    <link href="css/livros.css" rel="stylesheet"> 
    <link href="css/rank.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">
     <link href="css/fonts.css" rel="stylesheet">
    <link href="css/tema.css" rel="stylesheet">
    <link href="css/nome.menu.css" rel="stylesheet">
    <link href="css/videos.css" rel="stylesheet">
    <script src="js/Validacaoform.js"></script>
	<script src="assets/js/ie-emulation-modes-warning.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script> 
	<script type="text/javascript" src="js/script.js"></script> 
 
	
  </head>

	<body role="document">	
    
<?php include('menu.php');?>
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script src="assets/js/docs.min.js"></script>
	<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
		
<?php include('includes/incluir_pag.php');?>
		
		
	</body>
</html>
