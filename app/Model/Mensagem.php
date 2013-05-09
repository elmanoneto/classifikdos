<?php
class Mensagem extends AppModel{

	var $name = 'Mensagem';

      public $validate = array(
        'sender' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nome de Envio Ã© obrigatÃ³rio'
            )
        ),
        'receiver' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Destinatáio é obrigatório'
            )
        ),
        'title' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Título é obrigatório'
            )
        ),
        'message' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Mensagem é obrigatória'
            ),
        ),
    );

}
?>