<div class="conteudo_titulo"><?php echo $this->Html->image('enviarmensagem.jpg'); ?></div>
<div class="form_add">

    <?php $msg = $this->Session->flash(); if($msg != null){ ?>
    <div class="notificacao_sucesso">
        <p><?php echo $msg; ?></p>
    </div>
    <?php } ?>
    
    <div class="f">
        <?php echo $this->Form->create('Mensagem', array('controller' => 'mensagem', 'action' => 'send'));?>
        <?php echo $this->Form->input('receiver', array('label' => '', 'type' => 'hidden', 'value' => 
        $usuario['User']['username'])); ?>
        <label>Título</label>
        <?php echo $this->Form->input('title', array('label' => '')); ?>
        <label>Mensagem</label>
        <?php echo $this->Form->input('message', array('label' => '')); ?>

        <button type="submit">Responder</button>
    </div>
</div>