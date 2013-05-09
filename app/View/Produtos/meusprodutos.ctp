<div class="meusprodutos">

	<?php $msg = $this->Session->flash(); if($msg != null){ ?>
	<div class="notificacao_sucesso">
		<p><?php echo $msg; ?></p>
	</div>
	<?php } ?>

	<form action="/classifikdos/produtos/add">
		<button class="color red button">+ Cadastrar Produto</button>
	</form>

	<br clear="all" />

	<?php if(sizeof($produto) > 0){?>
	<table> 
		<thead> 
		<tr> 
		    <th>#</th> 
		    <th class="nome">Nome</th> 
		    <th class="preco">Preço</th> 
		    <th class="situacao">Situação</th> 
		    <th class="editar">Editar</th>
		    <th class="remover">Remover</th>
		</tr> 
		</thead> 
		<?php for($i = 0; $i < sizeof($produto); $i++){ $id =  $produto[$i]['Produto']['id']; ?>
		<tbody> 
		<tr class="corpo">

		    <td><?php echo $produto[$i]['Produto']['id']; ?></td> 

		    <td class="nome"><?php
		    $nome = $produto[$i]['Produto']['nome'];
		    echo $this->Html->link($nome, array('controller' => 'produtos', 'action' => 'view/'.$id));
		    ?></td> 

		    <td class="preco">R$<?php echo number_format($produto[$i]['Produto']['preco'], 2, ',', '.'); ?></td> 

		    <td class="situacao"><?php if($produto[$i]['Produto']['vendido'] == 0){ echo 'Disponível'; }else{
		    	echo 'Vendido'; } ?></td> 

		    <td class="editar"><?php
		    	echo $this->Html->image('icone-editar.gif', array ('alt' => 'Editar', 'url' => array('controller' => 'produtos', 'action' => 'edit/'.$id))); ?>
		    </td>

		    <td class="remover"><?php
		    	echo $this->Html->image('icone-excluir.gif', array ('alt' => 'Remover', 'url' => array('controller' => 'produtos', 'action' => 'delete/'.$id))); ?>
		    </td>
		   
		</tr> 
		</tbody> 
		 <?php } ?>
	</table>
	<?php }else{?>
	<h2>Você não tem nenhum produto cadastrado.</h2>
	<?php } ?>


</div>