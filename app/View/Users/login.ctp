<?php $msg = $this->Session->flash();
if($msg != null){ ?>
	<div class="notificacao_erro">
		<p><?php echo $msg; ?></p>
	</div>
	
<?php  
} 
?>

<?php $msg2 = $this->Session->flash('auth');
if($msg2 != null){ ?>
    <div class="notificacao_erro">
        <p><?php echo $msg2; ?></p>
    </div>
    
<?php  
} 
?>

<br clear="all" />

<div class="conteudo_titulo"><?php echo $this->Html->image('entrar.png', array(
    'alt' => 'Entrar',
    'title' => 'Entrar'
    )); ?></div>

<div class="form_add">
    <div class="f">
        <?php echo $this->Form->create('User');?>
                <label>Usuário</label>
                <?php echo $this->Form->input('username', array('label' => '')); ?>

                <label>Senha</label>
                <?php echo $this->Form->input('password', array('label' => ''));
            ?>
    </div>
    <button type="submit" class="">Entrar</button>

</div>