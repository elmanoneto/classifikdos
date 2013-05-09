<?php
class EstilosController extends AppController{

	public function estilizar(){

		$this->Estilo->usuario = $this->Session->read('Auth.User.username');

		$estilo = $this->Estilo->findByUsuario($this->Session->read('Auth.User.username'));

		$this->Estilo->id = $estilo['Estilo']['id'];

		if($this->request->is('post') || $this->request->is('put')){
			if($this->Estilo->save($this->request->data)){
				$this->redirect(array('controller' => 'users', 'action' => 'produtos/'
					.$this->Session->read('Auth.User.username')));
			}
		}

	}

}
?>