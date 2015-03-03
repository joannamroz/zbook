<?php
class MessagesController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		 $user_id=$this->Auth->user('id');
         $messages = $this->Message->find('all', array(
         			//'group' => array(
         				//pogrupuj według albo tam gdzie recipient_id albo sender_id ma to samo id co zalogowany user
         			//	'Message.recipient_id, Message.sender_id' 
         			//),
                    'conditions' => array('OR' => array(//albo 
                    	array(
                    		'sender_id'=>$user_id//nadawca jest nasz $id 
                    		),
                    	array(
                    		'recipient_id'=>$user_id// lub jest odbiorcą wiadomosci
                    		)
                    	)
                        
                    ),
                    'order' => array('Message.created' => 'desc')//według najnowszych
            ));
        $related_messages=array();
    	foreach ($messages as $key => $message) {
    		if($message['Message']['sender_id']==$user_id){
    			if (!isset($related_messages[  $message['Message']['recipient_id'] ] )) {
    				$related_messages[  $message['Message']['recipient_id']  ]=$message;
    			}	
    		}
    		if($message['Message']['recipient_id']==$user_id){
    			if (!isset($related_messages[  $message['Message']['sender_id']  ])) {
    				$related_messages[  $message['Message']['sender_id']  ]=$message;
    			}
    		}
        		
        }
        $this->set('messages',$related_messages);

    }
    public function conversations($id = null) {
    	$user_id=$this->Auth->user('id');
        $messages = $this->Message->find('all', array(
                    'conditions' => array('OR' => array(array('sender_id'=>$user_id,'recipient_id'=>$id), array('sender_id'=>$id,'recipient_id'=>$user_id))
                        
                    ),
                    'order' => array('Message.created' => 'desc')
            ));
        $this->set('messages',$messages);

        if (isset($this->request->data['Message'])) {

        	$this->Message->create();
        	$data_to_save=$this->request->data;

        	$data_to_save['Message']['sender_id']=$this->Auth->user('id');
        	$data_to_save['Message']['recipient_id']=$id;
			
        	if ($this->Message->save($data_to_save)) {
                    $this->Session->setFlash(__('The message has been send.'));
                    return $this->redirect(array('action' => 'conversations', $id));
                } else {
                    $this->Session->setFlash(__('The messages cannot be send. Please, try again.'));
                }              
        }
        $this->set('recipient_id',$id);

    }
	public function ajax_send() {
       $this->layout=false;
		if ($this->request->is('post')) {
			// var_dump("tak to jest post!");

    		$this->Message->create();
    		//pr($this->request->data);
    		$this->request->data['sender_id'] = $this->Auth->user('id');
    		// pr($this->request->data);die();
			
    		if ($this->Message->save($this->request->data)) {
    			$id_message = $this->Message->id;

    			$message = $this->Message->find('first', array('conditions'=>array('Message.id'=>$id_message)));
                //$this->Session->setFlash(__('Your book has been saved.'));
    			//$this->set(compact('users')); to znaczy to samo co to  $this->set('users',$users); 
    			$this->set('message',$message);

                return 1;
            } else{
            	return 0;
            }
    	} else {
    		pr('hola hola to nie wiadomość');
		}
	}
}
