<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $name = 'User';
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Usuário é obrigatório'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Senha é obrigatória'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'vendedor')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        ),
         'telephone' => array(
            'valid' => array(
                'rule' => array('notEmpty'),
                'message' => 'Telefone é obrigatório',
            )
        ),
         'name' => array(
            'valid' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nome é obrigatório',
            )
        ),
         'email' => array(
            'valid' => array(
                'rule' => array('email'),
                'message' => 'E-mail é obrigatório',
            )
        ),
         'age' => array(
            'valid' => array(
                'rule' => array('notEmpty'),
                'message' => 'Idade é obrigatório',
            )
        ),
    );
	
	public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
    return true;
}
	
}
?>