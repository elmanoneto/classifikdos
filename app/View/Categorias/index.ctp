<div class="conteudo_titulo"><?php echo $this->Html->image('categorias.jpg', array('alt' => 'Categorias', 'title' => 'Categorias')); ?></div>

<?php if(sizeof($categoria) < 1){?>
<div class="categoria_naoencontrada"><h2>Desclupe, nenhuma Categoria foi encontrada! :(</h2>
<?php }else{?>
<?php $msg = $this->Session->flash(); if($msg != null){?>
<div class="sucesso_categoria">
	<p><?php echo $msg; ?></p>
</div>
<?php } ?>

<div class="lista_categorias">
	<table>
		<tr>
			<td class="id"><strong>#</strong></td>
			<td class="nome"><strong>Nome</strong></td>
			<td class="editar"><strong>Editar</strong></td>
			<td class="excluir"><strong>Deletar</strong></td>
		</tr>
		<?php for($i = 0; $i < sizeof($categoria); $i++){?>
			<tr>
				<td class="id"><?php echo $categoria[$i]['Categoria']['id']; ?></td>
				<td class="nome"><?php echo $categoria[$i]['Categoria']['nome']; ?></td>
				<td class="editar">
					<?php echo $this->Html->image('icone-editar.gif'); ?>
				</td>
				<td class="excluir">
					<?php $var = $categoria[$i]['Categoria']['id']; echo $this->Html->link($this->Html->image('icone-excluir.gif', array('alt' => 'Deletar', 'title' => 'Deletar')), "delete/$var",	array('escape' => false));?>
				</td>
			</tr>
		<?php } ?>
	</table>
	<div class="cat"><?php echo $this->Html->link('Cadastrar Categoria', array('action' => 'add')); ?></div>
</div>
<?php } ?>