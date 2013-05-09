<div class="conteudo">
  <div class="mensagem">

    <label>Enviada por: <label><strong><?php echo $message['Mensagem']['sender']; ?></strong>
    <p><?php echo $message['Mensagem']['message']; ?></p>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php echo $this->Html->link('Responder', array('action' => 'reply/'.$message['Mensagem']['sender'])); ?>

  </div>
</div>



