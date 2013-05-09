<div class="menu_esquerdo">
	<?php echo $this->Html->image('busca.jpg', array('alt' => 'Busca', 'title' => 'Busca')); ?>
	<br />
	<?php echo $this->Form->create('Produto', array('action' => 'search')); ?>
	<label class="buscapreco">De R$</label>
	<?php echo $this->Form->input('de', array('type' => 'number', 'label' => '')); ?>
	<label class="buscapreco">Até R$</label>
	<?php echo $this->Form->input('ate', array('type' => 'number', 'label' => '')); ?>
	<button type="submit">Buscar</button>
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

<?php $msg = $this->Session->flash(); if($msg != null){ ?>
	<div class="notificacao_sucesso">
		<p><?php echo $msg; ?></p>
	</div>
<?php } ?>

<div class="conteudo_listagem">

	<br />

	<?php echo $this->Session->flash(); ?>

	<?php if(!$produto){ ?>

	<div class="nao_encontrado">
		<h3>Desculpe, nenhum produto encontrado! :(</h3>
	</div>

	<?php }else{ for($i = 0; $i < sizeof($produto); $i++){ ?>

	<div class="principal_produto">

		<?php
			if($produto[$i]['p']['foto'] == null){
				echo $this->Html->image('img.png');
				?>
				<?php echo $produto[$i]['p']['nome'];
				echo '<br />';
			}else{
			 echo $this->Html->image('uploads/'.$produto[$i]['p']['foto']);
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
	</div>
	
</div>