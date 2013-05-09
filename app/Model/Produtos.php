<?php
class Produtos extends AppModel{

	var $name = 'Produto';

      public $validate = array(
        'nome' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nome é obrigatório'
            )
        ),
        'descricao' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Descrição é obrigatória'
            )
        ),
        'preco' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Preço é obrigatório'
            )
        ),
        'categoria' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Categoria é obrigatória'
            )
        ),
    );

}
?>