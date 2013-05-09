<!-- app/View/Users/add.ctp -->

<?php $msg = $this->Session->flash();
if($msg != null){ ?>
	<div class="notificacao_erro">
		<p><?php echo $msg; ?></p>
	</div>
	
<?php  
} 
?>

<div class="form_add">
	<div class="f">
		<?php echo $this->Form->create('User');?>
    	
        <legend><?php echo __('Adicionar Usuário'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('Função', array(
            'options' => array('admin' => 'Administrador' ,'vendedor' => 'Vendedor')
        ));
    ?>
    <?php echo $this->Form->end(__('Submit'));?>
    </div>
</div>

