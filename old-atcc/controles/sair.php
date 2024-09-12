<?php 
require('classes/util.php');
$util= new Util();
destroy_session();
$util->redirecionamentopage('index.php');
?>