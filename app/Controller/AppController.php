<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

//use Facebook\FacebookSession;
//use Facebook\FacebookRedirectLoginHelper;

//FacebookSession::setDefaultApplication('872290539508304', 'ab8b0f43f71d83a0e6e6717bab3104e7');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'books',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
            'authorize' => array('Controller') // Added this line
        )
    );

    public function isAuthorized($user) {
	  
		if($this->Auth->loggedIn()){
            $this->layout='zbook';
			return  true;
		}else{
            $this->layout='notlogged';
        }
	    // Default deny
	    return false;
	}

    public function beforeFilter() {

        $this->Auth->loginRedirect = array('controller' => 'books', 'action' => 'index');
        $this->Auth->logoutRedirect = '/';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
    	
    }
    public function beforeRender() {
        $this->loadModel('Message');
        $count_msg=$this->Message->countUnread();
        
        $this->set('count_msg', $count_msg);

        $this->loadModel('Friend');
        $new_friends=$this->Friend->find('all', array('conditions'=>array( 'Friend.recipient_id'=>AuthComponent::user('id'),'Friend.answered'=>'0')));
        $this->set('new_friends', $new_friends);

    }
}
