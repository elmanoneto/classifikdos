<div class="menu_esquerdo">
	<?php if(!$this->Session->read('Auth.User')){?>
	<?php echo $this->Html->image('entrar.png', array('alt' => 'Entrar', 'title' => 'Entrar')); ?> <br />
	<?php echo $this->Form->create('User', array('action' => 'login'));?>
	<?php echo $this->Form->input('username', array('label' => '', 'placeholder' => 'Usuário')); ?>
	<?php echo $this->Form->input('password', array('label' => '', 'placeholder' => 'Senha')); ?>
	<button type="Submit">Acessar</button>
	<?php }else{
	echo $this->Html->image('minhaconta.jpg', array('alt' => 'Minha Conta', 'title' => 'Minha Conta')); ?> <br />
	<div class="categorias">
		<ul>
			<li><?php echo $this->Html->link('Meus Produtos', array('controller' => 'produtos', 'action' => 'meusprodutos')); ?></li>
			<li><?php echo $this->Html->link('Minhas Mensagens', array('controller' => 'mensagem')); ?>(<?php echo $cntdr; ?>)</li>
			<li><?php echo $this->Html->link('Estatísticas', array('controller' => 'estatistica', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('Editar Perfil',array('controller' => 'users', 'action' => 'edit/'.$this->Session->read('Auth.User.id'))); ?></li>
			<li><?php echo $this->Html->link('Minha Página', array('controller' => 'users', 'action' => 'produtos/'.$this->Session->read('Auth.User.username'))); ?></li>
			<li><?php echo $this->Html->link('Editar Minha Página', array('controller' => 'users', 'action' => 'estilo/'.$this->Session->read('Auth.User.username'))); ?></li>
			<li><?php
				$usr = $this->Session->read('Auth.User');
				$id = $usr['id'];
				echo $this->Html->link('Excluir Conta', array('controller' => 'users', 'action' => 'delete/'.$id), array('escape' => false, 'confirm' => 'Tem certeza que deseja excluir sua conta?')); ?>
			</li>
		</ul>
	</div>
	<?php } ?>
	<div class="categorias">
		<div class="titulo"> <?php echo $this->Html->image('categorias.png', array('alt' => 'Categorias', 'title' => 'Categorias')); ?> </div>
			<ul>
				<li><?php echo $this->Html->link('Todos os Produtos', array('controller' => 'produtos')); ?></li>
				<li><?php echo $this->Html->link('Informática', array('controller' => 'produtos', 'action' => 'informatica')); ?></li>
				<li><?php echo $this->Html->link('Eletrodomésticos', array('controller' => 'produtos', 'action' => 'eletrodomesticos')); ?></li>
			</ul>
		</div>
	
	</div>
</div>
<br />
<div class="conteudo_listagem">

	<?php if(!$produto){ ?>

	<div class="nao_encontrado">
		<h3>Desculpe, nenhum produto encontrado! :(</h3>
	</div>

	<?php }else{for($i = 0; $i < sizeof($produto); $i++){ ?>
	
	<div class="principal_produto">
		<?php
			if($produto[$i]['p']['foto'] == null){
				echo $this->Html->image('img.png', array('url' => array('controller' => 'produtos',
					'action' => 'view/'.$produto[$i]['p']['id'])));
				?>
				<?php echo $produto[$i]['p']['nome'];
				echo '<br />';
			}else{
			 $foto = $produto[$i]['p']['foto'];
			 echo $this->Html->image('uploads/'.$foto, array('url' => array('controller' => 'produtos', 
			 	'action' => 'view/'.$produto[$i]['p']['id']))); 
			 echo $produto[$i]['p']['nome'];
			 echo '<br />';
			}
		?> 
		<span class="preco">R$<?php echo number_format($produto[$i]['p']['preco'], 2, ',', '.'); ?></span>
		<?php
			 echo '<br />';
			 $id = $produto[$i]['p']['id'];
		?>
		<span class="detalhe"><?php echo $this->Html->link('Detalhes',array('controller' => 'produtos', 'action' => 'view/'.$id)); ?></span>
		
	</div>
	<?php }} ?>
	<br clear="all" />
	<br />
	<div class="paginacao">
		<?php 
			if ($pagina == 1)
				echo '< anterior';
			else 
				echo "<a href='?pag=".($pagina-1)."'>< anterior</a> ";

			for($i=1; $i<=$ultimaPagina ; $i++) { 
				if ($pagina == $i)
					echo " <a style='font-weight: bold;' href=?pag=".$i.">$i</a> "; 
				else
					echo " <a href=?pag=".$i.">$i</a> ";
			}

			if ($pagina == $ultimaPagina)
				echo 'proxima >';
			else 
				echo "<a href='?pag=".($pagina+1)."'> proxima > </a>";


		?>

		<?php
		/*
		echo $this->Paginator->prev('', null, null, array());
		echo $this->Paginator->numbers();
		echo $this->Paginator->next('', null, null, array('class' => 'disabled'));
		*/
		?>
	</div>

</div>