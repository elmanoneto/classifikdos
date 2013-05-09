<script>
/* M�scaras ER */  
function mascara(o,f){  
    v_obj=o  
    v_fun=f  
    setTimeout("execmascara()",1)  
}  
function execmascara(){  
    v_obj.value=v_fun(v_obj.value)  
}  
function mtel(v){  
    v=v.replace(/\D/g,"");             //Remove tudo o que n�o � d�gito  
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca par�nteses em volta dos dois primeiros d�gitos  
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca h�fen entre o quarto e o quinto d�gitos  
    return v;  
}  
</script>


<div class="conteudo_titulo"><?php echo $this->Html->image('cadastrese.jpg', array(
    'alt' => 'Cadastre-se',
    'title' => 'Cadastre-se'
    )); ?></div>
<div class="form_add">
    <div class="f">
        <?php echo $this->Form->create('User');?>
        <label>Nome</label>
        <?php echo $this->Form->input('name', array('label' => '')); ?>
        <label>Email</label>
        <?php echo $this->Form->input('email', array('label' => '')); ?>
        <label>Idade</label>
        <?php echo $this->Form->input('age', array('label' => '')); ?>
        <label>Telefone</label>
        <?php echo $this->Form->input('telephone', array('onKeyPress' => "mascara(this,mtel)" , 'label' => '')); ?>
        <label>Usu�rio</label>
        <?php echo $this->Form->input('username', array('label' => '')); ?>
        <label>Senha</label>
        <?php echo $this->Form->input('password', array('label' => '')); ?>
        

        <?php
        echo $this->Form->input('role', array(
                'options' => array('vendedor' => 'vendedor'), 'type' => 'hidden'
            ));
        ?>
        <button type="submit">Cadastrar</button>
    </div>
</div>