<?php
class FriendsController extends AppController {
	public $helpers = array('Html', 'Form');

	public function addFriend() {
        $this->layout=false;
    	$this->autoRender=false;
 
    	if ($this->request->is('post')) {

    		$this->Friend->create();
    		$this->request->data['sender_id'] = $this->Auth->user('id');
    		if ($this->Friend->save($this->request->data)) {
    			return 1;
    		}
        }        
    }

    public function friend_list(){
    	$user_id=AuthComponent::user('id');
    	$friendsAccepted = $this->Friend->find('all', array(
                    'conditions' => array(array('Friend.answered'=>'1','Friend.response'=>'1', 'OR' => array(
                    	array('sender_id'=>$user_id),//nadawca jest nasz $id	
                    		
                    	array('recipient_id'=>$user_id)// lub jest odbiorcą wiadomosci	
                    	)
                    ))
            ));
    	$this->set('friendsAccepted', $friendsAccepted);

    	$friendsInvitations = $this->Friend->find('all', array(
                    'conditions' => array('Friend.answered'=>'0', 'recipient_id'=>$user_id)
                    ));
    	$this->set('friendsInvitations', $friendsInvitations);
    }

    public function to_accept(){ //this view is no longer in use -> moved to friend_list view
    	$user_id=AuthComponent::user('id');
    	$friendsInvitations = $this->Friend->find('all', array(
                    'conditions' => array('Friend.answered'=>'0', 'recipient_id'=>$user_id)
                    ));
    	$this->set('friendsInvitations', $friendsInvitations);
    }
    public function delete_request(){
    	$this->layout=false;
    	$this->autoRender=false;
    	if ($this->request->is('post')) {
    		$data_to_save=$this->request->data;
    		$user_id = $this->Auth->user('id');
    		$wynik = $this->Friend->find('first', array("conditions"=> array("Friend.recipient_id"=>$user_id, "Friend.sender_id"=>$data_to_save["sender_id"])));
            
            $data_to_save['id']=$wynik['Friend']['id'];
            $data_to_save['response']=0;
            $data_to_save['answered']=1;
            $data_to_save['recipient_id']=$user_id;
            $data_to_save['sender_id']=$wynik['Friend']['sender_id'];
    		
    		if ($this->Friend->save($data_to_save)) {
    			return 1;
    		}
        }        
    }
    public function confirm(){
    	$this->layout=false;
    	$this->autoRender=false;
    	if ($this->request->is('post')) {
    		$data_to_save=$this->request->data;
    		$user_id = $this->Auth->user('id');
    		$wynik = $this->Friend->find('first', array("conditions"=> array("Friend.recipient_id"=>$user_id, "Friend.sender_id"=>$data_to_save["sender_id"])));
            $data_to_save['id']=$wynik['Friend']['id'];
            $data_to_save['response']=1;
            $data_to_save['answered']=1;
            $data_to_save['recipient_id']=$user_id;
            $data_to_save['sender_id']=$wynik['Friend']['sender_id'];
    		
    		if ($this->Friend->save($data_to_save)) {
    			return 1;
    		}
        }        
    }
    public function delete_friend(){
    	$this->layout=false;
    	$this->autoRender=false;
    	if ($this->request->is('post')) {
    		$data_to_save=$this->request->data;
    		$user_id = $this->Auth->user('id');
    		$wynik = $this->Friend->find('first', array("conditions"=> array("Friend.recipient_id"=>$user_id, "Friend.sender_id"=>$data_to_save["sender_id"])));
        
            $data_to_save['id']=$wynik['Friend']['id'];
            $data_to_save['response']=0;
            $data_to_save['answered']=1;
            $data_to_save['recipient_id']=$user_id;
            $data_to_save['sender_id']=$wynik['Friend']['sender_id'];
    		
    		if ($this->Friend->save($data_to_save)) {
    			return 1;
    		}
        }        
    }
}
