<?php if($_SESSION['perfil']=='Administrador'){?>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
        	
			
            <div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">                         
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="default.php?pg=visao/administrador/usuarios/consultar.usuarios.php">Usuarios já cadastrados</a></li>
								<li><a href="default.php?pg=visao/administrador/usuarios/inserir.usuario.php">Formulario de Cadastro usuario</a></li>
                                <li><a href="visao/administrador/usuarios/relatorio.php" target="_blank">Relatorio de todos usuarios</a></li>
							</ul>
                                    
                      
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Temas<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="default.php?pg=visao/administrador/temas/consultar.temas.php">Temas já cadastrados</a></li>
								<li><a href="default.php?pg=visao/administrador/temas/inserir.temas.php">Formulario de Cadastro Tema</a></li>
                                <li><a href="visao/administrador/temas/relatorio.php" target="_blank">Relatorio de todos temas</a></li>
							</ul>
                                    
                    
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ranck<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="default.php?pg=visao/administrador/rank/consultar.perguntas.php">Perguntas já cadastrados</a></li>
								<li><a href="default.php?pg=visao/administrador/rank/inserir.perguntas.php">Formulario de Cadastro Pergunta</a></li>
                                <li role="separator" class="divider"></li>
         						<li><a href="#">Separated link</a></li>
                                <li><a href="#">Separated link</a></li>
							</ul>       
         
				
							
							<li id='nome'><a href="#">Bem vindo <?php echo $_SESSION['nome'];?></a>
				</ul>				
				 
			</div>
	</div>
</nav>
<?php }?>






<?php if ($_SESSION['perfil']=='Aluno'){?>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>		
		</div>
					
					
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="default.php?pg=visao/aluno/casa.php">Principal</a></li>			
				
					<li class="dropdown">
						<a href="default.php?pg=visao/aluno/temas.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Temas <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="default.php?pg=visao/aluno/temas.php">Escolha seu tema</a></li>
							<li><a href="default.php?pg=visao/aluno/sujestaotema.php">Sujestione um tema</a></li>
						</ul>
          
			 
					<li><a href="default.php?pg=visao/aluno/rank.php">Rank</a></li>
				
				
					<li><a href="default.php?pg=visao/aluno/etapas.php">Etapas</a></li>
			 
				
					<li class="dropdown">
						<a href="default.php?pg=visao/aluno/arquivos.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Publicar Arquivos<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="default.php?pg=visao/aluno/livros.php">Livros</a></li>
							<li><a href="default.php?pg=visao/aluno/video.php">Video Aulas</a></li>
							<li><a href="default.php?pg=visao/aluno/site.php">Site</a></li>             
						</ul>
					
						<li id='nome'><a href="#">Bem vindo <?php echo $_SESSION['nome'];?></a>
           
		
			</ul>
		</div>
	</div>
</nav>


		
		
		
		
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<div id="foto">
						<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
							<div class="col-xs-6 col-sm-3 placeholder">
            
								<img id="perfil" src="img/perfil.jpg" width="150" height="150">
                    
							</div>
						</div>
					</div>
		
						<ul class="nav nav-sidebar">
							<li><a href="default.php?pg=visao/aluno/editaperfil.php">Editar perfil</a></li>
							<li><a href="#">Sair</a></li>
						</ul>
          
				</div>		
			</div>
		</div>
<?php }?>





<?php if ($_SESSION['perfil']=='Professor'){?>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>		
		</div>
					
					
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="default.php?pg=visao/professor/casa.php">Principal</a></li>			
				
					<li class="dropdown">
						<a href="default.php?pg=visao/aluno/temas.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Temas <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="default.php?pg=visao/professor/temas/consultar.temas.php">Temas já cadastrados</a></li>
							<li><a href="default.php?pg=visao/professor/temas/inserir.temas.php">Formulario de Cadastro Tema</a></li>
						</ul>
          
			 
					<li><a href="default.php?pg=visao/aluno/rank.php">Rank</a></li>
				
				
					<li><a href="default.php?pg=visao/aluno/etapas.php">Etapas</a></li>
			 
				
					<li class="dropdown">
						<a href="default.php?pg=visao/aluno/arquivos.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Arquivos <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="default.php?pg=visao/aluno/livros.php">Livros</a></li>
							<li><a href="default.php?pg=visao/aluno/video.php">Video Aulas</a></li>
							<li><a href="default.php?pg=visao/aluno/site.php">Site</a></li>             
						</ul>
					
						<li id='nome'><a href="#">Bem vindo <?php echo $_SESSION['nome'];?></a>
           
		
			</ul>
		</div>
	</div>
</nav>


		
		
		
		
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<div id="foto">
						<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
							<div class="col-xs-6 col-sm-3 placeholder">
            
								<img id="perfil" src="img/perfil.jpg" width="150" height="150">
                    
							</div>
						</div>
					</div>
		
						<ul class="nav nav-sidebar">
							<li><a href="default.php?pg=visao/professor/editaperfil.php">Editar perfil</a></li>
							<li><a href="#">Sair</a></li>
						</ul>
          
				</div>		
			</div>
		</div>
<?php }?>


