<?php


// app/Controller/UsersController.php
App::uses('AppController', 'Controller');
App::uses('Author', 'Model');
App::uses('Book', 'Model');
App::uses('Rating', 'Model');


class UsersController extends AppController {

    public $components = array('Paginator');
     public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'logout');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->Paginator->settings = array(    
           'order' => array('User.fullname'=>'asc')
        );
        $users = $this->Paginator->paginate('User');
        
        // $users=$this->User->find('all',array('order' => array('User.fullname' => 'asc')));->drugi sposób bez paginacji
        $this->set('users',$users);
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        //do zmiennej $user_data przypisujemy pobrany jeden rekord z bazy danych z tabeli users 
        //read() is used to retrieve a single record from the database, $id specifies the ID of the record to be read
        $user_data=$this->User->read(null, $id);

        $this->set('user', $user_data);
        
    }

    public function add() {
        $this->layout='notlogged';
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit() {

        $user_id=$this->Auth->user('id');
        $this->User->id = $user_id;
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->read(null, $user_id);
            //pr($this->request->data);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        
        //allowMethod pozwala tylko na delete user poprzez metode post/ nie przez np geta w url-u
        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
    // app/Controller/UsersController.php

   

    public function login() {
        $this->layout='notlogged';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect(array('controller'=>'books', 'action' => 'index'));
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    public function user_book(){
        $this->loadModel('Rating');

        $this->layout='zbook';
        $user_id=$this->Auth->user('id');

        //http://book.cakephp.org/2.0/en/models/model-attributes.html
        //jest to atrybut modelu ktory jesli robimy find na tym modelu to pobierzemy glebsze relacje
        //jak jest user-books-author to majac 0 i 1 dojedziemy tylko do books i user a majac 2 to jeszcze do authora
        $this->Rating->recursive = 2;
        $user_books=$this->Rating->find('all', array('conditions'=>array('Rating.user_id'=>$user_id)));
        //pr($user_books);
        $this->set('user_books', $user_books);
    }
    public function profile() {
        $user_id=$this->Auth->user('id');
        //pr($user_id);die();
        $user_data=$this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
        //pr($user_data);die();
        $this->set('user_data', $user_data);
        $this->set('user_id', $user_id);

        //pobrane celem wyświetlenia pozycji polubionych/ocenionych książek podglądanego użytkownika
        // $this->loadModel('Rating');
        // $user_info=$this->Rating->find('all', array('conditions'=>array('Rating.user_id'=>$user_id)));
        // $this->set('user_info', $user_info);

        $this->loadModel('Message');
        $user_message=$this->Message->find('all', array(
            'conditions'=>array('Message.recipient_id'=>$user_id),
             'order' => array('Message.created' => 'desc')));
        $this->set('user_message',$user_message);


    }
    public function view_user($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }

        $user_info = $this->User->findById($id);
        if (!$user_info) {
            throw new NotFoundException(__('Invalid user'));
        }
        
        $this->set('user_info', $user_info);
        $this->loadModel('Message');
        

        if ($this->request->is('post')) {
            $this->Message->create();
            $data_to_save=$this->request->data;
            // pr($data_to_save);die();
            $data_to_save['Message']['sender_id']=$this->Auth->user('id');
            $data_to_save['Message']['recipient_id']=$id;
            if ($this->Message->save($data_to_save)) {
                 $this->Session->setFlash(__('Your message has been send.'));

                //przekierowanie do widoku index
                return $this->redirect(array('controller'=>'users', 'action' => 'view_user', $user_info['User']['id']));
            }

        }

        $this->loadModel('Friend');
        $isAFriend=$this->Friend->find('first', array('conditions'=>array('Friend.recipient_id'=>$id,'Friend.sender_id'=>AuthComponent::user('id'))));
        $isAFriend=count($isAFriend);
        $this->set('isAFriend',$isAFriend);

    }
    public function edit_avatar($id = null) {
        $this->User->id = $id;
        if ($this->request->is('post'))  {
            //pr($this->request->data);
            $filename = $this->request->data['User']['avatar']['name'];
            //pr($filename);

            //do zmiennej $ext pobieramy funkcje pathinfo rozszerzenei pliku
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            //pr($ext);
            // do zmiennej name_hash wpisujemy losowy "hash" ktorym bedzie nowa nazwa nazsego pliczku I doklejamy kropke oraz rozszerzenie zeby powstala dobra nazwa pliczku
            $name_hash = md5(uniqid(rand(), true)).'.'.$ext;
            //pr($name_hash);die();
            //spr czy jest katalog covers i jeśli nie ma to go tworzymy mkdir:)
            if (!is_dir('img/avatars')) {
                mkdir('img/avatars');
            }
            $destination='img/avatars/'.$name_hash;

            if (move_uploaded_file($this->data['User']['avatar']['tmp_name'], $destination)) {
                // save message to session 
                $this->Session->setFlash('File uploaded successfuly.');

                $user_update['id'] = $id;
                $user_update['avatar'] = '/'.$destination;
                //pr($user_update);die();
                $this->User->save($user_update);
                $this->Session->write('Auth', $this->User->read(null, $this->Auth->user('id')));

            } else {
                $this->Session->setFlash('error while saving file');
            }
        }
    }
    
}