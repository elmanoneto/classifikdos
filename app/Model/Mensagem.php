<?php
class Mensagem extends AppModel{

	var $name = 'Mensagem';

      public $validate = array(
        'sender' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nome de Envio é obrigatório'
            )
        ),
        'receiver' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Destinat�io � obrigat�rio'
            )
        ),
        'title' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'T�tulo � obrigat�rio'
            )
        ),
        'message' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Mensagem � obrigat�ria'
            ),
        ),
    );

}
?>