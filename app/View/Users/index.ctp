<?php
	if(sizeof($users) == 0){?>
		<div class="users">
			<h3>Nenhum usuário cadastrado.</h3>
		</div>
	<?php }else{ for($i = 0; $i < sizeof($users); $i++){?>
		<div class="lista_usuarios">
			<div class="usuario">
				<h3><?php echo $users[$i]['User']['username']; ?></h3>
				<strong><p>Recomendações: <?php echo $users[$i]['User']['recommendation']; ?></p></strong>
				<p>Produtos Vendidos: 0</p>
				<?php $usr = $this->Session->read('Auth.User'); $id = $usr['id'];
				if($id != $users[$i]['User']['id']){
					echo '<p>Recomendar</p>';
				}?>
			</div>
		</div>		
	<?php }}
?>