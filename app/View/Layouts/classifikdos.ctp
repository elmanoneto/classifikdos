<!doctype html>
<html lang="pt-br">
<head>	
	<title>Classifikdos</title>

	<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="/classifikdos/css/busca.css" />
	<link rel="stylesheet" type="text/css" href="/classifikdos/css/notification.css" />
	<link rel="stylesheet" type="text/css" href="/classifikdos/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/classifikdos/css/jquery-ui.css" />
	<script src="/classifikdos/js/jquery-1.8.3.js"></script>
    	<script src="/classifikdos/js/jquery-ui.js"></script>
        <script type="text/javascript">
        	$(document).ready(function () {	$('.notificacao_sucesso').delay('3000').hide('puff');
        	$('.notificacao_erro').delay('3000').hide('puff');
        	$('#username').autocomplete({
	      		source: 'users'
	    		});
        	});
    	</script>
    <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>

    <!--start Facebook Open Graph Protocol-->
	<meta property="og:site_name" content="Classikfods" />
	<meta property="og:title" content="Classifikdos" />
	<meta property="og:url" content="http://localhost/classifikdos/site/"/>
	<meta property="og:image" content="http://seusite.com/url-da-pagina/imagem-da-pagina.gif"/>
	<meta property="og:description" content="Classificados Online de Produtos."/>
	<!--end Facebook Open Graph Protocol-->

</head>
	<body>
		<div id="topo">
			<div class="conteudo_topo">
				<div class="logo_topo">
					<?php echo $this->Html->image('logo.jpg', array('alt' => 'Classifikdos', 'title' => 'Classifikdos', 'url' => array('controller' => 'site'))); ?>

					<div class="menu">
						<ul>
							<?php if(!$this->Session->read('Auth.User')){?>
							<li><a href="/classifikdos/users/join">Cadastre-se</a></li>
							<li class="barra">|</li>
							<li><a href="/classifikdos/users/login">Entrar</a></li>
							<?php }else{ ?>
							<li class="sair"><a href="/classifikdos/users/logout">Sair</a></li>
							<?php } ?>
						</ul>
					</div>

					<div class="busca">
						<?php echo $this->Form->create('Produto', array('class' => 'form-wrapper cf', 'action' => 'search', 'metohd' => 'post')); ?>
					        <input type="text" placeholder="Digite o que você esta procurando.." required name="busca">
					        <button type="submit">Buscar</button>
				  	  	</form>
				    </div>

				</div>
			</div> 	
		</div>

		<div id="conteudo">
			<?php echo $this->fetch('content'); ?>
		</div>

		<br clear="all" />
		<br />

		<div id="foo">
			<hr />
			Classifikdos <?php echo date('Y'); ?>. Powered by CakePHP.
			<br />
			Developed by: Danilo Formiga, Diego Lorran, Elmano Neto, Jorge Lima, Márcia Cabral e Petrus Carvalho.
		</div>

	</body>
</html>