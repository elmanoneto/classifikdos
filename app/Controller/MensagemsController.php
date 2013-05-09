<?php
class MensagemsController extends AppController{

	public function send(){

		$mensagem = $this->loadModel('Mensagem');
		//print_r($this->request->data);


		
		if($this->request->is('post')){
			$this->Mensagem->create();
			if(!empty($this->data)){
				$user = $this->Session->read('Auth.User');

				$m['Mensagem']['receiver'] = $this->request->data['Mensagem']['receiver'];
				$m['Mensagem']['title'] = $this->request->data['Mensagem']['title'];
				$m['Mensagem']['message'] = $this->request->data['Mensagem']['message'];


				$m['Mensagem']['sender'] = $user['username'];

				if($this->Mensagem->save($m)){
					$this->Session->setFlash('Mensagem enviada com sucesso!');
					$this->redirect(array('controller' => 'mensagem', 'action' => 'index'));
					
				}
			}
		}

	}
	
}
?>