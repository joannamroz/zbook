<?php
class FriendsController extends AppController {
	public $helpers = array('Html', 'Form');

	public function addFriend() {
        $this->layout=false;
    	$this->autoRender=false;
 
    	if ($this->request->is('post')) {
    		var_dump("tak to jest post!");

    		$this->Friend->create();
    		//pr($this->request->data);
    		$this->request->data['sender_id'] = $this->Auth->user('id');
    		if ($this->Friend->save($this->request->data)) {
    			return 1;
    		}
        }        
    }
}
