<div class="conteudo_titulo"><?php echo $this->Html->image('editarproduto.jpg'); ?></div>

<div class="form_add">

	<?php echo $this->Form->create('Produto'); ?>

<div class="f">
	<?php echo $this->Form->input('id'); ?>

	<label>Nome</label>
	<?php echo $this->Form->input('nome', array('label' => '', 'class' => 'f')); ?>

	<label>Descriçãoo</label>
	<?php echo $this->Form->input('descricao', array('label' => '')); ?>

	<label>Preço</label>
	<?php echo $this->Form->input('preco', array('label' => '')); ?>

	<label>Foto</label>
	<?php echo $this->Form->input('foto', array('label' => '', 'type' => 'file')); ?>

	<label>Data</label>
	<?php echo $this->Form->input('data', array('label' => '')); ?>

	<label>Restrito</label>
	<div class="restrito"><?php echo $this->Form->input('restrito', array('label' => '')); ?></div>

	<label>Liberado Para</label>
	<br />
	<select multiple="multiple" name="select[]">
		<option selected value="1">-- Selecione --</option>
		<?php for($i = 0; $i < sizeof($user); $i++){
			if($user[$i]['User']['username'] == $this->Session->read('Auth.User.username')){
				continue;
			}else{
				echo '<option value='.$user[$i]['User']['username'].'>'.$user[$i]['User']['username'].'</option>';
			}
		}?>
	</select>

	<label>Categoria</label>
	<br />
	<?php echo $this->Form->input(
    'categoria',
    array(
        'options' => $categoria,
        'type' => 'select',
        'empty' => '-- Selecione --',
        'label' => ''
    )
	); ?>

	<label>Vendido</label>
	<?php echo $this->Form->input('vendido', array('label' => '', 'class' => 'situacao')); ?>
</div>

	<button type="submit">Editar</button>

	<span class="btnlimpar"><button type="reset">Limpar</button></span>
</div>