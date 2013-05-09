<?php $msg = $this->Session->flash();
if($msg != null){ ?>
	<div class="notificacao_erro">
		<p><?php echo $msg; ?></p>
	</div>
	
<?php  } 
?>

<div class="t_prod">
	<h3><?php echo $produto['Produto']['nome']; ?></h3>
</div>

<div class="foto_produto">
<?php if($produto['Produto']['foto'] == null){
	echo $this->Html->image('img.png');
}else{
	echo '<img src=../../img/uploads/'.$produto['Produto']['foto'].'>';
}
?>

</div>

<div class="detalhe_produto">
	<p><?php echo $produto['Produto']['descricao']; ?></p>
	<span class="detalhe_preco">Preço: R$<?php echo number_format($produto['Produto']['preco'], 2, ',', '.'); ?></span>
	<p>Vendedor: <?php echo $this->Html->link($produto['Produto']['vendedor'],
	array('controller' => 'users', 'action' => 'produtos/'.$produto['Produto']['vendedor'])); ?></p>
	<p>Reputação do vendedor: <?php
	if($recomendacoes == 0){
		echo 'Vendedor sem reputação';
	}else if($recomendacoes == 1){
		echo $this->Html->image('estrela.jpg');
	}else if($recomendacoes == 2){
		echo $this->Html->image('estrela2.jpg');
	}else if($recomendacoes == 3){
		echo $this->Html->image('estrela3.jpg');
	}else if($recomendacoes == 4){
		echo $this->Html->image('estrela4.jpg');
	}else{
		echo $this->Html->image('estrela5.jpg');
	}
	?>
	</p>
	<p>Contato: <?php echo $telefone; ?></p>
	<?php
	if($this->Session->read('Auth.User')){
	$username = $this->Session->read('Auth.User.username');
	if($username != $produto['Produto']['vendedor']){
	echo $this->Html->link('Recomendar Vendedor',array('controller' => 'users', 'action' => 'recomendar/'.$produto['Produto']['vendedor'])); ?>
	<br/><br/><br/><br/><br/><br/>
	<?php
	echo $this->Html->link('NÃO Recomendar Vendedor',array('controller' => 'users', 'action' => 'naorecomendar/'.$produto['Produto']['vendedor']));
	?>
	<?php }} ?>
	<br>
	<br>
	<br>
	<br>
	<?php $current_url= 'http://classifikdos.com.br/produtos/view/'.$produto['Produto']['id'];?>
	<br/>
	<a onclick="window.open('https://www.facebook.com/sharer/sharer.php?&u=<?php echo urlencode($current_url) ?>;', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');"> <img src="https://s-static.ak.facebook.com/rsrc.php/v1/yX/r/syeRiv4y8Z1.gif"></a>
</div>
