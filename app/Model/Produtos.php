<?php
class Produtos extends AppModel{

	var $name = 'Produto';

      public $validate = array(
        'nome' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nome � obrigat�rio'
            )
        ),
        'descricao' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Descri��o � obrigat�ria'
            )
        ),
        'preco' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Pre�o � obrigat�rio'
            )
        ),
        'categoria' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Categoria � obrigat�ria'
            )
        ),
    );

}
?>