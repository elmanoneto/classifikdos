<div class="minhasmensagens">

	<?php $msg = $this->Session->flash(); if($msg != null){ ?>
	<div class="notificacao_sucesso">
		<p><?php echo $msg; ?></p>
	</div>
	<?php } ?>


	<div class="newmsg">
		<form action="/classifikdos/mensagem/send">
			<button class="color red button">Nova Mensagem</button>
		</form>
	</div>

	<br clear="all" />

	<?php $counter = 0 ?>
	<?php if(sizeof($message) > 0){?>
	<table> 
		<thead> 
		<tr> 
		    <th class="titulo">Título</th>
		    <th class="remetente">Enviado Por</th> 
		    <th class="lido">Lido</th> 
		    <th class="data">Data e Hora</th> 
		    <th class="remover">Remover</th>
		</tr> 
		</thead> 
			
		<?php $user = $this->Session->read('Auth.User'); $username = $user['username']; ?>

		<?php for($i = 0; $i < sizeof($message); $i++){ $id =  $message[$i]['Mensagem']['id']; ?>
		
		<tbody> 
		<tr class="corpo">

			<?php if($message[$i]['Mensagem']['receiver'] == $username) { ?>

			<?php $counter++ ?> 

		    <td class="titulo">
		    <?php 
		    $titulo = $message[$i]['Mensagem']['title'];
		    echo $this->Html->link($titulo, array('controller' => 'mensagem', 'action' => 'view/'.$id));
		    ?></td> 

		    <td class="remetente"><?php
		    echo $message[$i]['Mensagem']['sender'];
		  
		    ?></td> 

		    <td class="lido"><?php if($message[$i]['Mensagem']['status'] == 0){ echo 'Não'; }else{
		    	echo 'Sim'; } ?></td> 

		    	 <td class="data"><?php echo $message[$i]['Mensagem']['created']; ?></td>


		    <td class="remover"><?php
		    	echo $this->Html->image('icone-excluir.gif', array ('alt' => 'Remover', 'url' => array('controller' => 'mensagem', 'action' => 'delete/'.$id))); ?>
		    </td>

			<?php } ?>

		   
		</tr> 
		</tbody> 
		 <?php } ?>
	</table>
	<?php }if ($counter == 0){?>
	<h2>Você não tem nenhuma mensagem</h2>
	<?php } ?>

</div>