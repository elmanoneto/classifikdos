<div class="search">
	<div class="conteudo_listagem2">
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
				 echo "<img width='210px' height='145px' class='detail' src=../img/uploads/".$produto[$i]['p']['foto'] .">"; 
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


	</div>

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