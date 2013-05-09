<div class="conteudo_titulo"><?php echo $this->Html->image('resultadobusca.jpg'); ?></div>

<div class="search">
	<div class="conteudo_listagem">
		<?php if(!$produto){ ?>

		<div class="nao_encontrado">
			<h3>Desculpe, nenhum produto encontrado! :(</h3>
		</div>

		<?php }else{ for($i = 0; $i < sizeof($produto); $i++){ ?>
		
		<div class="principal_produto">
			<?php
				if($produto[$i]['Produto']['foto'] == null){
					echo $this->Html->image('img.png');
					?>
					<?php echo $produto[$i]['Produto']['nome'];
					echo '<br />';
				}else{
				 echo "<img width='210px' height='145px' class='detail' src=../img/uploads/".$produto[$i]['Produto']['foto'] .">"; 
				 echo $produto[$i]['Produto']['nome'];
				 echo '<br />';
				}
			?> 
			<span class="preco">R$<?php echo $produto[$i]['Produto']['preco']; ?></span>
			<?php
				 echo '<br />';
				 $id = $produto[$i]['Produto']['id'];
			?>
			<span class="detalhe"><?php echo $this->Html->link('Detalhes',array('controller' => 'produtos', 'action' => 'view/'.$id)); ?></span>
			
		</div>
		<?php }} ?>
	</div>
</div>