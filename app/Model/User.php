<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $name = 'User';
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Usu�rio � obrigat�rio'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Senha � obrigat�ria'
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
                'message' => 'Telefone � obrigat�rio',
            )
        ),
         'name' => array(
            'valid' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nome � obrigat�rio',
            )
        ),
         'email' => array(
            'valid' => array(
                'rule' => array('email'),
                'message' => 'E-mail � obrigat�rio',
            )
        ),
         'age' => array(
            'valid' => array(
                'rule' => array('notEmpty'),
                'message' => 'Idade � obrigat�rio',
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