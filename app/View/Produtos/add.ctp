<div class="conteudo_titulo"><?php echo $this->Html->image('addproduto.jpg'); ?></div>

<div class="form_add">

	<?php echo $this->Form->create('Produto', array('action' => 'add', 'type' => 'file')); ?>

<div class="f">
	<label>Nome</label>
	<?php echo $this->Form->input('nome', array('label' => '', 'class' => 'f')); ?>

	<label>Descrição</label>
	<?php echo $this->Form->input('descricao', array('label' => '')); ?>

	<label>Preço</label>
	<?php echo $this->Form->input('preco', array('label' => '')); ?>

	<label>Foto</label>
	<?php echo $this->Form->input('foto', array('label' => '', 'type' => 'file')); ?>

	<label>Data</label>
	<?php echo $this->Form->input('data', array('label' => '')); ?>

	<?php $this->Form->input('vendido', array('value' => 0, 'label' => '')); ?>

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

	<br />

	<label>Categoria</label><br />
	<?php echo $this->Form->input(
    'categoria',
    array(
        'options' => $categoria,
        'type' => 'select',
        'empty' => '-- Selecione --',
        'label' => ''
    )
	); ?>

</div>

	<button type="submit">Adicionar</button>

	<span class="btnlimpar"><button type="reset">Limpar</button></span>
</div>