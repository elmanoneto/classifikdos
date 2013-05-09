<?php
class ProdutosController extends AppController{

	#Carregar os componentes para tratamento de requisição e sessão.
	var $components = array('RequestHandler', 'Session', 'Auth');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index', 'view', 'search', 'informatica', 'eletrodomesticos');
	}

	public function index(){
		#Seta o layout classifikdos.
		$this->layout = 'classifikdos';

		$this->loadModel('Categorias');

		$this->loadModel('Produtos');

		$this->set('categoria', $this->Categorias->find('all'));

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

		$this->set('ultimaPagina', $ultimaPagina);

		$this->set('produto', $produtos2);

		$this->set('pagina', $pagina);
	}

	public function add(){
		$this->layout = 'classifikdos';
		
		$this->loadModel('Categorias');
		$this->loadModel('User');
		$this->loadModel('Permissao');

		$this->set('user', $this->User->find('all', array('fields' => array('User.username'))));

		$this->set('categoria', $this->Categorias->find('list', array('fields' => array('Categorias.nome'))));
			
		if($this->request->is('post')){
			$this->Produto->create();
			if(!empty($this->data)){
			$user = $this->Session->read('Auth.User');

			$target = "img/uploads/"; 
 			$target = $target . basename($this->data['Produto']['foto']['name']);

			$this->prod = $this->request->data;

 			$foto = $this->data['Produto']['foto']['name'];

 			$this->prod['Produto']['vendedor'] = $user['username'];

 			if($this->data['Produto']['foto']['name'] == ""){
 				$this->prod['Produto']['foto'] = null;
 				if($this->Produto->save($this->prod)){
 					$this->Permissao->create();
 					$p = $this->Produto->findByDescricao($this->prod['Produto']['descricao']);

 					for($i = 0; $i < sizeof($_POST['select']); $i++){
 						$this->Permissao->set('usuario', $_POST['select'][$i]);
 						$this->Permissao->set('id_produto', $p['Produto']['id']);
 						$this->Permissao->save();
 					}
					$this->Session->setFlash('Produto adicionado com sucesso!');
					$this->redirect(array('action' => 'meusprodutos'));
				}
 			}else{
 				$this->prod['Produto']['foto'] = $foto;
	 			if($this->Produto->save($this->prod) && move_uploaded_file($_FILES['data']['tmp_name']['Produto']['foto'], $target)){
					$this->Session->setFlash('Produto adicionado com sucesso!');
					$this->redirect(array('action' => 'meusprodutos'));
				}
 			}
		}
		}

	}

	public function delete($id){
		$this->Produto->id = $id;

		if(!$this->Produto->exists()){
			$this->redirect(array('action' => 'index'));
		}

 		$p = $this->Produto->findById($id);
		$user = $this->Session->read('Auth.User');
		if($p['Produto']['vendedor'] != $user['username']){
			$this->redirect(array('controller' => 'site'));
		}

		$target = "img/uploads/" . basename($p['Produto']['foto']);
 		unlink($target);

		#Deleta o produto e redireciona a página.
		$this->Produto->delete($id);
		$this->Session->setFlash('Produto deletado com sucesso.');

		$this->redirect(array('action' => 'meusprodutos'));
	}

	public function view($id = null){
		$this->layout = 'classifikdos';

		$this->loadModel('User');

		$this->loadModel('Recomendacao');



		$this->Produto->id = $id;

		#Verifica se o produto existe, se existe vai voltar para a página de detalhes, se não, volta
		#para a lista.
		if(!$this->Produto->exists()){
			$this->redirect(array('action' => 'index'));
		}else{
			$p = $this->Produto->read('Produto.vendedor');
			$vendedor = $this->User->findByUsername($p['Produto']['vendedor']);
			$this->set('telefone', $vendedor['User']['telephone']);
			$this->set('produto', $this->Produto->read());

			$recomendacoes = $this->Recomendacao->findAllByRecomendado($p['Produto']['vendedor']);

			$this->set('recomendacoes', sizeof($recomendacoes));
		}
	}

	public function edit($id = null){
		$this->layout = 'classifikdos';

		$this->loadModel('User');
		$this->loadModel('Permissao');

		$this->set('user', $this->User->find('all', array('fields' => array('User.username'))));

		$this->Produto->id = $id;

		$this->loadModel('Categorias');

		$this->set('categoria', $this->Categorias->find('list', array('fields' => array('Categorias.nome'))));

		#Verifica se o produto existe, se não existe vai voltar para a página de detalhes, se não,
		#vai para o formulário de editar.
		if(!$this->Produto->exists()){
			$this->redirect(array('controller' => 'site'));
		}else{
			if(empty($this->data)){
				$p = $this->Produto->findById($id);
				$user = $this->Session->read('Auth.User');
				if($p['Produto']['vendedor'] != $user['username']){
					$this->redirect(array('controller' => 'site'));
				}
				$this->data = $this->Produto->read();
			}else{
				if($this->Produto->save($this->data)){
					$this->prod = $this->request->data;
					$this->Permissao->create();
 					$p = $this->Produto->findByDescricao($this->prod['Produto']['descricao']);

 					for($i = 0; $i < sizeof($_POST['select']); $i++){
 						$this->Permissao->set('usuario', $_POST['select'][$i]);
 						$this->Permissao->set('id_produto', $p['Produto']['id']);
 						$this->Permissao->save();
 					}
					$this->Session->setFlash('Produto editado com sucesso');
					$this->redirect(array('controller' => 'produtos', 'action' => 'meusprodutos'));
				}
			}
		}
	}

	public function meusprodutos(){
		$this->layout = 'classifikdos';
		$user = $this->Session->read('Auth.User');
		$produtos = $this->Produto->findAllByVendedor($user);
		$this->set('produto', $produtos);
	}

	public function search(){
		$this->layout = 'classifikdos';

		if(!empty($this->data['busca'])){
			$busca = $this->data['busca'];
			
			$conditions = array("OR" => array(
				"Produto.nome LIKE" => "%$busca%",
				"Produto.descricao LIKE" => "%$busca%"
			));

			$this->set('produto', $this->Produto->find('all', array('conditions' => $conditions)));
		}else{
			if(empty($this->data['Produto']['de']) || empty($this->data['Produto']['ate'])){
				$this->redirect(array('action' => 'index'));
			}else{
				$de = $this->data['Produto']['de'];
				$ate = $this->data['Produto']['ate'];
				$conditions = array('Produto.preco BETWEEN  '.$de.' and '.$ate.'');
				$this->set('produto', $this->Produto->find('all', array('conditions' => $conditions)));
			}
		}

	}

	public function informatica(){
		$this->layout = 'classifikdos';

		$this->loadModel('Produtos');

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

		$this->set('ultimaPagina', $ultimaPagina);

		$this->set('produto', $produtos2);

		$this->set('pagina', $pagina);
	}

	public function eletrodomesticos(){
		$this->layout = 'classifikdos';

		$this->loadModel('Produtos');

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

		$this->set('ultimaPagina', $ultimaPagina);

		$this->set('produto', $produtos2);

		$this->set('pagina', $pagina);
	}


}
?>