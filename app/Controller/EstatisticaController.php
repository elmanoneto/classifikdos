	<?php
class EstatisticaController extends AppController{

	public function view($id = null){
		$this->layout = 'classifikdos';
	
		}

	

	public function index(){
		$this->loadModel('Recomendacao');
		$this->loadModel('NaoRecomendacao');
		$this->loadModel('User');
		$this->loadModel('Produtos');
		#Seta o layout classifikdos.
		$this->layout = 'classifikdos';

		$user = $this->Session->read('Auth.User');

		$recomendacaoTotal = $this->Recomendacao->find('all');
		$usuarioTotal = $this->User->find('all');
		$idadeTotal = $this->User->find('first',array('fields' => array('SUM(User.age) AS total')));  

		$idadeUser = $this->User->findAllByUsername($user['username']);

		$recomendacao = $this->Recomendacao->findAllByRecomendado($user['username']);
		$naorecomendacao = $this->NaoRecomendacao->findAllByRecomendado($user['username']);
		$produtosAnunciados = $this->Produtos->findAllByVendedor($user['username']);
		$produtosVendidos = $this->Produtos->find('all', array("conditions" => array("Produtos.vendedor" => $user['username'], "AND" => array("Produtos.vendido" => 1))));

		$mediaIdade = ($idadeTotal[0]['total']/sizeof($usuarioTotal));

		$mediaRecomendacao = (sizeof($recomendacaoTotal)/sizeof($usuarioTotal));

		$this->set('tamRecomendacao', sizeof($recomendacao));
		$this->set('tamNaoRecomendacao', sizeof($naorecomendacao));
		$this->set('tamMediaRecomendacaoTotal', $mediaRecomendacao);

		$this->set('tamProdutosAnunciados', sizeof($produtosAnunciados));
		$this->set('tamProdutosVendidos', sizeof($produtosVendidos));

		$this->set('mediaIdadeTotal', $mediaIdade);
		$this->set('idadeUser', $idadeUser[0]['User']['age']);

		}


	
	}
?>