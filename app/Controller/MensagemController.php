<?php
class MensagemController extends AppController{

	public function view($id = null){
		$this->layout = 'classifikdos';

		$this->Mensagem->id = $id;
		if(!$this->Mensagem->exists()){
			$this->redirect(array('action' => 'index'));
		}else{
			$dados = array("Mensagem"=>array ("id"=>$id,"status"=>1));
			$this->Mensagem->set($dados);
			$this->Mensagem->save();
			$this->set('message', $this->Mensagem->read());
			
		}
	}

	public function send(){
		#Seta o layout classifikdos.
		$this->layout = 'classifikdos';

		if($this->request->is('post')){
			$this->Mensagem->create();
			if(!empty($this->data)){
				$user = $this->Session->read('Auth.User');

				$this->message = $this->request->data;

				$this->message['Mensagem']['sender'] = $user['username'];

				if($this->Mensagem->save($this->message)){
					$this->Session->setFlash('Mensagem enviada com sucesso!');
					$this->redirect(array('action' => 'index'));
					
				}
			}
		}
	}

	public function index(){
		#Seta o layout classifikdos.
		$this->layout = 'classifikdos';

		#Seta a variável mensagem para a view, essa variável carrega todos as mensagens do banco.
		$user = $this->Session->read('Auth.User');
		$username = $user['username'];
		$msg = $this->Mensagem->find('all');
		$this->set('message', $msg);
	}



	public function delete($id){
		$this->Mensagem->id = $id;

		if(!$this->Mensagem->exists()){
			$this->redirect(array('action' => 'index'));
		}

 		$m = $this->Mensagem->findById($id);
		$user = $this->Session->read('Auth.User');
		if($m['Mensagem']['receiver'] != $user['username']){
			$this->redirect(array('controller' => 'site'));
		}

		#Deleta o produto e redireciona a página.
		$this->Mensagem->delete($id);
		$this->Session->setFlash('Mensagem deletada com sucesso.');

		$this->redirect(array('action' => 'index'));
	}

	public function users(){
		$this->layout = false;
		$this->loadModel('User');
		$user = $this->User->find('all', array('fields' => 'username'));

		$list = array();

		foreach($user as $users){
			array_push($list, $users['User']['username']);
		}

        $this->set('users', $list);
	}

	public function reply($user = null){
		$this->layout = 'classifikdos';

		$this->loadModel('User');

		$usuario = $this->User->findByUsername($user);
		
		$this->set('usuario', $usuario);
	}

}
?>