<?php
class SiteController extends AppController{

	var $components = array('Session', 'Auth');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index');
	}

	public function index(){
		$this->layout = 'classifikdos';

		$this->loadModel('Produtos');
		$this->loadModel('Permissao');
		$this->loadModel('Categorias');
		$this->loadModel('Mensagem');
		$this->loadModel('Recomendacao');
		$this->loadModel('Users');

		$msg = $this->Mensagem->find('all');

		if($this->Session->read('Auth.User.username')){
			$user = $this->Session->read('Auth.User.username');
		}else{
			$user = 'naoexiste';
		}

		$pagina = addslashes(strip_tags(@$_GET['pag']));

		if ($pagina == "" or $pagina == null) {
			$pagina = 1;
		}

		$registros = 6;


		$totalQuery = $this->Produtos->query("select count(*) as total from produtos p where p.vendido = false and (restrito = false or (p.id in (select id_produto from permissaos where usuario = '".$user."')))");
		
		$totalProdutos = $totalQuery[0][0]['total'];

		if ($totalProdutos < $registros)  {
			$ultimaPagina = 1;
		} else {
			$ultimaPagina = ceil($totalProdutos / $registros);
		}

		$limit = ($pagina-1) * $registros;
		
		$produtos2 = $this->Produtos->query("select * from produtos p where p.vendido = false and (restrito = false or (p.id in (select id_produto from permissaos where usuario = '".$user."'))) limit $limit,$registros");

//		    $options = array(
//			'conditions' => array('Produtos.vendido' => 0),
//			'order' => array('Produtos.id' => 'DESC'),
//			'limit' => 6
//	);

//		$this->paginate = $produtos2;

		//$produtos = $this->paginate('Produtos');

		$this->set('ultimaPagina', $ultimaPagina);

		$this->set('produto', $produtos2);

		$this->set('pagina', $pagina);

		//$produtos = $this->Produtos->findAllByVendido('0', array(), array('Produtos.id' => 'DESC'));

		//$this->set('produto', $produtos);

		$this->set('categoria', $this->Categorias->find('all'));

		$user = $this->Session->read('Auth.User');
		
		if($this->Session->read('Auth.User')){
			
			$produtos = $this->Produtos->findAllByVendedor($user);

			$contador = 0;
			for($i = 0; $i < sizeof($produtos); $i++){
				if($produtos[$i]['Produtos']['vendido'] == 1){
					$contador++;
				}
			}

			$this->set('contador', $contador);

			$contador2 = 0;
			for($i = 0; $i < sizeof($msg); $i++){
				if($msg[$i]['Mensagem']['status'] == 0 && $msg[$i]['Mensagem']['receiver'] == $user['username']){
					$contador2++;
				}
			}

			$this->set('cntdr', $contador2);
		}

		$recomendacao = $this->Recomendacao->findAllByRecomendado($user['username']);
		$this->set('tamRecomendacao', sizeof($recomendacao));
	}

}
?>