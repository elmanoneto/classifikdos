<?php
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('join', 'produtos');
    }

    public function view($user = null) {
        $this->layout = 'classifikdos';
    }

    public function add() {
        $this->loadModel('Estilos');

        if ($this->request->is('post')) {
            $this->User->create();
            $this->Estilo->create();
            if ($this->User->save($this->request->data)) {

                print_r($this->request->data);
                //$this->redirect(array('action' => 'index'));
            } else {
               //$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function join() {
        $this->layout = 'classifikdos';

        $this->loadModel('Estilos');

        if($this->Session->read('Auth.User')){
            $this->redirect(array('controller' => 'site'));
        }
        
        if ($this->request->is('post')) {
            $this->usuario = $this->request->data;
            $this->usuario['User']['role'] = 'vendedor';
            $this->User->create();

            $estilo['usuario'] = $this->usuario['User']['username'];
            $estilo['cor'] = '#fff';
            $estilo['paginacao'] = 6;
            $e['Estilos'] = $estilo;
            $this->Estilos->create();

            if ($this->User->save($this->usuario) && $this->Estilos->save($e)) {
                //$this->Session->setFlash(__('Usuário cadastrado com sucesso'));
                print_r($this->e);
                $this->redirect(array('controller' => 'site'));
            } else {
                //$this->Session->setFlash(__('Ocorreu um erro ao salvar o usuário. Tente novamente.'));
            }
        }
    }

    public function edit($id = null) {
        $this->layout = 'classifikdos';
        $this->User->id = $id;

        $user = $this->User->findById($id);

        $user2 = $this->Session->read('Auth.User');

        if($user['User']['id'] == $user2['id']){
            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->User->save($this->request->data)) {
                    //$this->Session->setFlash(__('Usuário editado com sucesso'));
                    $this->redirect(array('controller' => 'site'));
                }else{
                    //$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            }else{
                $this->request->data = $this->User->read(null, $id);
                unset($this->request->data['User']['password']);
            }
        }else{
            $this->redirect(array('controller' => 'site'));
        }

    }

    public function delete($id = null) {
        array('escape' => false, 'confirm' => 'Clear list?');
        $this->loadModel('Produtos');

        $this->loadModel('Estilos');

        $this->User->id = $id;
    
        $user = $this->User->findById($id);

        $user2 = $this->Session->read('Auth.User');

        if($user['User']['id'] == $user2['id']){
            $this->Produtos->deleteAll(array('vendedor' => $user2['name']));
            $this->Estilos->deleteAll(array('usuario' => $user2['name']));
            $this->User->delete();
            $this->logout();
        }else{        
            $this->redirect(array('controller' => 'site'));
        }
    }

    public function login(){
        $this->layout = 'classifikdos';
        if($this->request->is('POST')){
            if($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            }else{
                $this->Session->setFlash('Usuário e/ou Senha inválidos');
            }
        }
    }

    public function logout() {
        $this->Auth->logout();
        $this->redirect(array('controller' => 'site'));
    }

    public function getUsername(){
        return $this->Auth->user('username');
    }

    public function recomendar($recomendado){
        $this->loadModel('Recomendacao');

        $recomendou = $this->getUsername();
        $flag = false;
        $this->recomendacao = $this->request->data;
        $verificacao =$this->Recomendacao->find('all',array('fields'=>array('Recomendacao.recomendou','Recomendacao.recomendado')));
        for ($i=0; $i < sizeof($verificacao); $i++) { 
            if($verificacao[$i]['Recomendacao']['recomendou'] == $recomendou and $verificacao[$i]['Recomendacao']['recomendado'] == $recomendado){
                $flag = true;
                $this->redirect($this->referer());
            }
        }

        if(!$flag){
        $this->recomendacao['Recomendacao']['recomendou'] = $recomendou;
        $this->recomendacao['Recomendacao']['recomendado'] = $recomendado;
        $this->Recomendacao->save($this->recomendacao);
        $this->redirect(array('controller' => 'site'));
        }else{
            $this->Session->setFlash('Você já recomendou esse usuário');
            $this->redirect($this->referer());
        }
    }

    public function naorecomendar($recomendado){

        $this->loadModel('NaoRecomendacao');

        $recomendou = $this->getUsername();
        $flag = false;
        $this->naorecomendacao = $this->request->data;
        $verificacao = $this->NaoRecomendacao->find('all',array('fields'=>array('NaoRecomendacao.recomendou','NaoRecomendacao.recomendado')));
        for ($i=0; $i < sizeof($verificacao); $i++) { 
            if($verificacao[$i]['NaoRecomendacao']['recomendou'] == $recomendou and $verificacao[$i]['NaoRecomendacao']['recomendado'] == $recomendado){
                $flag = true;
                $this->redirect($this->referer());
            }
        }

        if(!$flag){

        $this->naorecomendacao['NaoRecomendacao']['recomendou'] = $recomendou;
        $this->naorecomendacao['NaoRecomendacao']['recomendado'] = $recomendado;
        $this->NaoRecomendacao->save($this->naorecomendacao);
        $this->redirect(array('controller' => 'site'));
        }else{
            $this->Session->setFlash('Você já recomendou esse usuário');
            echo '<script>window.history.back();</script>';
        }
    }

    public function estilo($username = null){
        $this->layout = 'classifikdos';

        if(!$this->User->findByUsername($username)){
            $this->redirect(array('controller' => 'site'));
        }
    }

    public function estilizar(){
        $this->redirect(array('action' => 'produtos/'.$this->Session->read('Auth.User.username')));
    }

    public function produtos($username = null){      
        $this->layout = 'classifikdos';

        $this->loadModel('Estilo');
        $this->loadModel('Produto');

        $usuario = $this->User->findByUsername($username);

        if($usuario){
            $estilo = $this->Estilo->findByUsuario($username);
            $this->set('cor', $estilo['Estilo']['cor']);

            $options = array(
            'conditions' => array('Produto.vendedor' => $usuario['User']['username']),
            'order' => array('Produto.id' => 'DESC'),
            'limit' => $estilo['Estilo']['paginacao']
            );
            $this->paginate = $options;
            $produtos = $this->paginate('Produto');
            $this->set('produto', $produtos);
        }else{
            $this->redirect(array('controller' => 'site'));
        }    

    }
     
}        

?>