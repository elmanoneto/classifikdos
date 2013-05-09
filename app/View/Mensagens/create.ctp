<div class="form_add">
    <div class="f">
        <?php echo $this->Form->create('Mensagem');?>
        <label>Destinatário</label>
        <?php echo $this->Form->input('receiver', array('label' => '')); ?>
        <label>Titulo da Mensagem</label>
        <?php echo $this->Form->input('title', array('label' => '')); ?>
        <label>Mensagem</label>
        <?php echo $this->Form->input('message', array('label' => '')); ?>
        

        <button type="submit">Cadastrar</button>
    </div>
</div>