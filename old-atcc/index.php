<?php 
require_once('controles/login.php');
Processo('login');?>

<htm>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="icon/atcc.ico">

    <title>ATCC</title>

    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <script src="js/Validacaoform.js"></script>
    <link href="css/carousel.css" rel="stylesheet">
	
	
	
  </head>
  <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
                    
                    <div id="titulo">
                    <a class="navbar-brand" href="#"><h1 id="titulo">A.T.C.C</h1></a></br>
					<a class="navbar-brand" href="#"><h3>Auxiliador de Trabalho de Conclusão de Curso</h3></a>
                 </div>   
				</div>
					
					
					
					 <div id="login">
					<div id="navbar" class="navbar-collapse collapse">
						<form class="navbar-form navbar-right" id="form" name="form" method="post">
		
                            
                            <div class="form-group">
								<input type="text" placeholder="Login" name="login" id="login" title="O campo usuário é obrigatório" class="form-control">
							</div>
								<div class="form-group">
									<input type="password" placeholder="Senha" name="senha" id="senha" title="O campo senha é obrigatório" class="form-control">
								</div>
									<button type="button" class="btn btn-default" name="button" id="button" onClick="validar(document.form);"> Entrar</button>
      <input type="hidden" name="ok" id="ok" />
       
                                    
								</br>
								
<div id="rsen">

<a href="recuperarsenha.html">Esqueceu sua senha?</a>
						</div>
                        </form>
                        
					</div>
                    </div>
					
					
			</div>
		</nav>


   
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
     
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>
			
			
					<div class="carousel-inner" role="listbox">
						
						<div class="item active">
							<img class="first-slide" src="img/obj.jpg" alt="First slide">
								<div class="container">
									<div class="carousel-caption">
                                    
										<h1 id="fonte">OBJETIVO</h1>
										<p id="fontep">Ajudar na orientação do aluno disponibilizando sujestões de temas, Orientatores e todo o processo dividido em etapas, neste caminho dificio que é o T.C.C.</p>
									</div>
								</div>
						</div>
       
						
						<div class="item">
							<img class="second-slide" src="img/vers.jpg" alt="Second slide">
								<div class="container">
									<div class="carousel-caption">
										<h1 id="fonte">VERSATILIDADE</h1>
										<p id="fontep">O Sistema será versatil e irá funcionar em desktop e plataformas mobile, facilitando o seu uso onde você estiver.</p>
              
									</div>
								</div>
						</div>
       

						<div class="item">
							<img class="third-slide" src="img/cont.jpg" alt="Third slide">
								<div class="container">
									<div class="carousel-caption">
										<h1 id="fonte">CONTEUDO</h1>
										<p id="fontep">O Sistema não só tem a comunicação entre aluno e orientador como tambem tem conteudos como ajuda com perguntas e respostas e uma biblioteca de arquivos.</p>
            							 
									</div>
								</div>
						</div>
					</div>
					
					
					
					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					
					
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
		</div>


   

			<div class="container marketing">
				<footer>
					<p>&copy; 2016 UNIABEU. &middot; <a href="visao/politica.privacidade.html">Política de Privacidade</a>
				</footer>

			</div>


   
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
		<script src="dist/js/bootstrap.min.js"></script>
		<script src="assets/js/vendor/holder.min.js"></script>
		<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
