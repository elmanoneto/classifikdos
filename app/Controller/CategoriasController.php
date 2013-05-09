<?php
class CategoriasController extends AppController{

	var $components = array('RequestHandler', 'Session');

	public function index(){
		$this->layout = 'classifikdos';

		$this->set('categoria', $this->Categoria->find('all'));
	}

	public function add(){

		$this->layout = 'classifikdos';
			
		if(!empty($this->data)){
			if($this->Categoria->save($this->data)){
				$this->Session->setFlash('Categoria adicionada com sucesso!');
				$this->redirect(array('action' => 'index'));
			}
		}

	}

	public function edit(){

	}

	public function delete($id){
		$this->Categoria->id = $id;

		$categoria = $this->Categoria->read();

		if(sizeof($categoria) < 1){
			$this->redirect(array('action' => 'index'));
		}

		$this->Categoria->delete($id);
		$this->Session->setFlash('Categoria removida com sucesso.');
		$this->redirect(array('action' => 'index'));
	}

}
?>