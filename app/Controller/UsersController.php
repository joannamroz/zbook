<?php
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

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
        $this->Auth->allow('add', 'logout', 'login', 'facebook_redirect');
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

    public function login() {
        
        $this->layout='notlogged';

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect(array('controller'=>'books', 'action' => 'index'));
            }

            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
        echo '<br>';
        CakeSession::start();

        FacebookSession::setDefaultApplication('872290539508304', 'ab8b0f43f71d83a0e6e6717bab3104e7');
      
        $helper = new FacebookRedirectLoginHelper(Router::fullbaseUrl().'/users/facebook_redirect');
        
        $loginUrl = $helper->getLoginUrl(array('scope' => 'email, user_birthday'));
        $this->set('fbLoginUrl', $loginUrl);
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    public function user_book(){
        $this->loadModel('Rating');

        $this->layout='zbook';
        $user_id=$this->Auth->user('id');

       // pobieramy glebsze relacje
        $this->Rating->recursive = 2;
        $user_books=$this->Rating->find('all', array('conditions'=>array('Rating.user_id'=>$user_id)));
        
        $this->set('user_books', $user_books);
    }
    public function profile() {
        $user_id=$this->Auth->user('id');
      
        $user_data=$this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
        $this->set('user_data', $user_data);
        $this->set('user_id', $user_id);

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
        
        
        $this->loadModel('Message');    

        if ($this->request->is('post')) {
            $this->Message->create();
            $data_to_save=$this->request->data;
           
            $data_to_save['Message']['sender_id']=$this->Auth->user('id');
            $data_to_save['Message']['recipient_id']=$id;
            if ($this->Message->save($data_to_save)) {
                 $this->Session->setFlash(__('Your message has been send.'));
                return $this->redirect(array('controller'=>'users', 'action' => 'view_user', $user_info['User']['id']));
            }

        }
        $user_id=AuthComponent::user('id');

        $this->loadModel('Friend');
        $isAFriend = $this->Friend->find('first', array(
                    'conditions' => array(array('Friend.answered'=>'1','Friend.response'=>'1', 'OR' =>array(
                        array(array(
                                    'Friend.sender_id'=>$user_id),//nadawca jest nasz $id    
                            
                            array(
                                    'Friend.recipient_id'=>$id)),
                        array(array(
                                    'Friend.sender_id'=>$id),
                            array(
                                    'Friend.recipient_id'=>$user_id))// lub jest odbiorcą wiadomosci  
                    ))
            )));
        $isAFriend=count($isAFriend);

        $mineFriendsId=$this->Friend->findUserFriendsByUserId(AuthComponent::user('id'));
        $mineFriends=$this->User->find('all',array('conditions'=>array('User.id'=>$mineFriendsId)));
      
        $usersFriendsId=$this->Friend->findUserFriendsByUserId($user_info['User']['id']);
        $usersFriends=$this->User->find('all',array('conditions'=>array('User.id'=>$usersFriendsId)));
      
        $result = array_intersect($mineFriendsId, $usersFriendsId);
        $mutual=$this->User->find('all',array('conditions'=>array('User.id'=>$result)));
       
        $this->loadModel('Rating');
        $this->Rating->recursive= 2;
        $userLibrary=$this->Rating->find('all', array(       
            'conditions'=>array('Rating.user_id'=>$id),'order' => array('Rating.note' => 'desc')));
        $this->set('userLibrary', $userLibrary);

        $this->set('user_info', $user_info);
        $this->set('isAFriend',$isAFriend);
        $this->set('mutual',$mutual);
        $this->set('mineFriends', $mineFriends);
        $this->set('userFriends', $usersFriends);


    }
    public function edit_avatar($id = null) {
        $this->User->id = $id;
        if ($this->request->is('post'))  {
            
            $filename = $this->request->data['User']['avatar']['name'];
        
            //do zmiennej $ext pobieramy funkcje pathinfo rozszerzenei pliku
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
            $name_hash = md5(uniqid(rand(), true)).'.'.$ext;
          
            if (!is_dir('img/avatars')) {
                mkdir('img/avatars');
            }
            $destination='img/avatars/'.$name_hash;

            if (move_uploaded_file($this->data['User']['avatar']['tmp_name'], $destination)) {
                $this->Session->setFlash('File uploaded successfuly.');

                $user_update['id'] = $id;
                $user_update['avatar'] = '/'.$destination;
                $this->User->save($user_update);
                $this->Session->write('Auth', $this->User->read(null, $this->Auth->user('id')));

            } else {
                $this->Session->setFlash('error while saving file');
            }
        }
    }

    public function facebook_redirect() {


        $this->layout='ajax';

        CakeSession::start();

        FacebookSession::setDefaultApplication('872290539508304', 'ab8b0f43f71d83a0e6e6717bab3104e7');

        $helper = new FacebookRedirectLoginHelper(Router::fullbaseUrl().'/users/facebook_redirect');
       
        $session = $helper->getSessionFromRedirect();


        if ($session) {

            $request = new FacebookRequest($session, 'GET', '/me');
            $response = $request->execute();
            $graphObject = $response->getGraphObject();
          
            $usrId=$graphObject->getProperty('id');
            $usrEmail=$graphObject->getProperty('email');

            $userFuid=$this->User->find('first',array('conditions'=>array('User.fuid'=>$usrId)));
            $arrayData=$graphObject->asArray();


            if($userFuid){
                $this->Auth->login($userFuid['User']);
                return $this->redirect(array('controller'=>'books','action' => 'index'));
            }else{
                $userEmail=$this->User->find('first',array('conditions'=>array('User.email'=>$usrEmail)));
                if($userEmail){
                    $this->Auth->login($userEmail['User']);
                    return $this->redirect(array('controller'=>'books','action' => 'index'));
                }else{

                    $dateOfBirth = DateTime::createFromFormat('m/d/Y', $arrayData['birthday']);
                    $birthday=$dateOfBirth->format('Y-m-d');

                    $reset_token = bin2hex(openssl_random_pseudo_bytes(15));
                    $this->User->create();
                    $newUser=array(
                        'fuid'=> $arrayData['id'],
                        'username'=> $arrayData['name'],
                        'password'=> $reset_token,
                        'fullname'=>$arrayData['name'],
                        'email'=>$arrayData['email'],
                        'gender'=>$arrayData['gender'],
                        'date_of_birth'=>$birthday
                    );
                    if ($this->User->save($newUser)) {
                        $this->Session->setFlash(__('The user has been saved'));
                        $new=$this->User->id;
                        $newUserId=$this->User->find('first', array('conditions'=>array('User.id'=>$new)));
                        $this->Auth->login($newUserId['User']);
                        return $this->redirect(array('controller'=>'books','action' => 'index'));
                    }
                }
            }

        }

    }
    
}
